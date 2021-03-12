<?php

namespace srag\CustomInputGUIs\M365File;

/**
 * Trait CustomInputGUIsTrait
 *
 * @package srag\CustomInputGUIs\M365File
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
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
