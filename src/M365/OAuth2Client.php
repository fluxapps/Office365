<?php

namespace srag\Plugins\M365File\M365;

use League\OAuth2\Client\Provider\GenericProvider;
use srag\Plugins\M365File\Utils\M365FileTrait;
use srag\Plugins\M365File\Config\Form\FormBuilder;
use srag\Plugins\M365File\Model\APIToken\APITokenDTO;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

/**
 * Class OAuth2Client
 * @package srag\Plugins\M365File\M365
 * @author  Theodor Truffer <tt@studer-raimann.ch>
 */
class OAuth2Client
{
    use M365FileTrait;

    const LOGIN_URL = 'https://login.microsoftonline.com/';
    protected static $scopes = [
        'offline_access',
        'Files.ReadWrite.All',
        'Files.ReadWrite.AppFolder'
    ];

    /**
     * @var GenericProvider
     */
    protected $oauth2_provider;

    /**
     * OAuth2Client constructor.
     */
    public function __construct()
    {
        $this->oauth2_provider = new GenericProvider([
            'clientId' => $this->config()->getValue(FormBuilder::KEY_CLIENT_ID),
            'clientSecret' => $this->config()->getValue(FormBuilder::KEY_CLIENT_SECRET),
            'urlAuthorize' => $this->getOAuth2BasePath() . '/authorize',
            'urlAccessToken' => $this->getOAuth2BasePath() . '/token',
            'urlResourceOwnerDetails' => $this->getOAuth2BasePath() . '/resource',
        ]);
    }

    /**
     * @return APITokenDTO
     * @throws IdentityProviderException
     */
    public function acquireNewAccessToken() : APITokenDTO
    {
        $token = $this->oauth2_provider->getAccessToken("password", [
            "username" => $this->config()->getValue(FormBuilder::KEY_USERNAME),
            "password" => $this->config()->getValue(FormBuilder::KEY_PASSWORD),
            "scope" => implode(' ', self::$scopes)
        ]);
        return new APITokenDTO(
            $token->getToken(),
            $token->getRefreshToken(),
            $token->getExpires()
        );
    }

    private function getOAuth2BasePath() : string
    {
        return self::LOGIN_URL . $this->config()->getValue(FormBuilder::KEY_TENANT_ID) . '/oauth2/v2.0';
    }

    /**
     * @param string $refresh_token
     * @return APITokenDTO
     * @throws IdentityProviderException
     */
    public function refreshToken(string $refresh_token) : APITokenDTO
    {
        $token = $this->oauth2_provider->getAccessToken("refresh_token", [
            "refresh_token" => $refresh_token,
            "scope" => implode(' ', self::$scopes)
        ]);
        return new APITokenDTO(
            $token->getToken(),
            $token->getRefreshToken(),
            $token->getExpires()
        );
    }

}
