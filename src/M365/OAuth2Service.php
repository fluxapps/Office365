<?php

namespace srag\Plugins\M365File\M365;

use srag\Plugins\M365File\Model\APIToken\APITokenRepository;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use srag\Plugins\M365File\Utils\M365FileTrait;
use srag\Plugins\M365File\Model\APIToken\APITokenDTO;

/**
 * Class OAuth2Service
 * @package srag\Plugins\M365File\M365
 * @author  Theodor Truffer <tt@studer-raimann.ch>
 */
class OAuth2Service
{
    use M365FileTrait;

    /**
     * @var OAuth2Client
     */
    private $oauth2Client;
    /**
     * @var APITokenRepository
     */
    private $token_repository;

    /**
     * OAuth2Service constructor.
     * @param OAuth2Client       $oauth2Client
     * @param APITokenRepository $token_repository
     */
    public function __construct(OAuth2Client $oauth2Client, APITokenRepository $token_repository)
    {
        $this->oauth2Client = $oauth2Client;
        $this->token_repository = $token_repository;
    }

    public function isAuthorized() : bool
    {
        return $this->token_repository->isTokenValid();
    }

    /**
     * @throws IdentityProviderException
     */
    public function authorize()
    {
        $token = $this->token_repository->getToken();
        if (is_null($token) || !$token->getRefreshToken()) {
            $this->log()->info('no refresh token found, fetching new access token from api');
            $this->token_repository->replaceToken(
                $this->oauth2Client->acquireNewAccessToken()
            );
        } else {
            $this->log()->info('refreshing access token');
            try {
                $this->token_repository->replaceToken(
                    $this->oauth2Client->refreshToken($token->getRefreshToken())
                );
            } catch (IdentityProviderException $e) {
                $this->log()->info('refresh failed with message: ' . $e->getMessage());
                $this->log()->info('flush token and re-authorize..');
                $this->token_repository->flushToken();
                $this->authorize();
            }
        }
    }

    /**
     * @return APITokenDTO
     * @throws IdentityProviderException
     */
    public function getAccessToken() : APITokenDTO
    {
        if (!$this->isAuthorized()) {
            $this->authorize();
        }
        return $this->token_repository->getToken();
    }

}
