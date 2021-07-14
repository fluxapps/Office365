<?php

namespace srag\ActiveRecordConfig\M365File\Config;

use srag\DIC\M365File\DICTrait;

/**
 * Class AbstractFactory
 *
 * @package srag\ActiveRecordConfig\M365File\Config
 */
abstract class AbstractFactory
{

    use DICTrait;

    /**
     * AbstractFactory constructor
     */
    protected function __construct()
    {

    }


    /**
     * @return Config
     */
    public function newInstance() : Config
    {
        $config = new Config();

        return $config;
    }
}
