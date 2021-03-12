<?php

namespace srag\Plugins\M365File\Utils;

use srag\Plugins\M365File\Repository;

/**
 * Trait M365FileTrait
 *
 * Generated by SrPluginGenerator v2.8.1
 *
 * @package srag\Plugins\M365File\Utils
 *
 * @author studer + raimann ag <support@studer-raimann.ch>
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
trait M365FileTrait
{

    /**
     * @return Repository
     */
    protected static function m365File() : Repository
    {
        return Repository::getInstance();
    }
}
