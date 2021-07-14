<?php

namespace srag\RemovePluginDataConfirm\M365File;

/**
 * Trait PluginUninstallTrait
 *
 * @package srag\RemovePluginDataConfirm\M365File
 */
trait PluginUninstallTrait
{

    use BasePluginUninstallTrait;

    /**
     * @internal
     */
    protected final function afterUninstall()/*: void*/
    {

    }


    /**
     * @return bool
     *
     * @internal
     */
    protected final function beforeUninstall() : bool
    {
        return $this->pluginUninstall();
    }
}
