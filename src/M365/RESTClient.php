<?php

namespace srag\Plugins\M365File\M365;

use srag\Plugins\M365File\Utils\M365FileTrait;

/**
 * Class Client
 * @package M365
 * @author  Theodor Truffer <tt@studer-raimann.ch>
 */
class RESTClient
{

    use M365FileTrait;

    /**
     * @var OAuth2Service
     */
    private $oauth2Service;

    /**
     * RESTClient constructor.
     * @param OAuth2Service $oauth2Service
     */
    public function __construct(OAuth2Service $oauth2Service)
    {
        $this->oauth2Service = $oauth2Service;
    }

    public function test()
    {

        if (!$this->oauth2Service->isAuthorized()) {
            $this->oauth2Service->authorize();
        }
    }

}
