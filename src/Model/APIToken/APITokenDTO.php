<?php

namespace srag\Plugins\M365File\Model\APIToken;

/**
 * @author  Theodor Truffer <tt@studer-raimann.ch>
 */
class APITokenDTO
{
    /**
     * @var string
     */
    private $access_token;
    /**
     * @var string
     */
    private $refresh_token;
    /**
     * @var int
     */
    private $expiry;

    /**
     * APIToken constructor.
     * @param string $access_token
     * @param string $refresh_token
     * @param int    $expiry
     */
    public function __construct(string $access_token, string $refresh_token, int $expiry)
    {
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;
        $this->expiry = $expiry;
    }


    public function serializeJson() : string
    {
        return json_encode([
            'access_token' => $this->access_token,
            'refresh_token' => $this->refresh_token,
            'expiry' => $this->expiry
        ]);
    }

    public static function unserializeJson(string $json) : self
    {
        $stdClass = json_decode($json);
        return new self(
            $stdClass->access_token,
            $stdClass->refresh_token,
            $stdClass->expiry
        );
    }

    public function getRefreshToken() : string
    {
        return $this->refresh_token;
    }

    /**
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->access_token;
    }
    /**
     * @return int
     */
    public function getExpiry() : int
    {
        return $this->expiry;
    }
}
