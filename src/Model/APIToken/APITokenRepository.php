<?php

namespace srag\Plugins\M365File\Model\APIToken;

use srag\Plugins\M365File\Utils\M365FileTrait;
use srag\Plugins\M365File\Config\Form\FormBuilder;

/**
 * Uses the plugin config to store and load the api token
 *
 * @author  Theodor Truffer <tt@studer-raimann.ch>
 */
class APITokenRepository
{

    use M365FileTrait;

    /**
     * @return APITokenDTO|null
     */
    public function getToken() /*: ?APIToken*/
    {
        $serialized_token = $this->config()->getValue(FormBuilder::KEY_TOKEN);
        if (!$serialized_token) {
            return null;
        }
        return APITokenDTO::unserializeJson($serialized_token);
    }

    public function isTokenValid() : bool
    {
        $token = $this->getToken();
        if (is_null($token)) {
            return false;
        }
        return $token->getExpiry() > time();
    }

    public function replaceToken(APITokenDTO $api_token)
    {
        $this->config()->setValue(FormBuilder::KEY_TOKEN, $api_token->serializeJson());
    }

    public function flushToken()
    {
        $this->config()->removeValue(FormBuilder::KEY_TOKEN);
    }
}
