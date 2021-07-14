<?php

namespace srag\DIC\M365File\Plugin;

/**
 * Interface Pluginable
 *
 * @package srag\DIC\M365File\Plugin
 */
interface Pluginable
{

    /**
     * @return PluginInterface
     */
    public function getPlugin() : PluginInterface;


    /**
     * @param PluginInterface $plugin
     *
     * @return static
     */
    public function withPlugin(PluginInterface $plugin)/*: static*/ ;
}
