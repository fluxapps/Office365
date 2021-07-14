<?php

namespace srag\CustomInputGUIs\M365File;

/**
 * Trait CustomInputGUIsTrait
 *
 * @package srag\CustomInputGUIs\M365File
 */
trait CustomInputGUIsTrait
{

    /**
     * @return CustomInputGUIs
     */
    protected static final function customInputGUIs() : CustomInputGUIs
    {
        return CustomInputGUIs::getInstance();
    }
}
