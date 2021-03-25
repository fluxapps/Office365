<?php

namespace srag\Plugins\M365File\Config\Form;

use srag\Plugins\M365File\Config\ConfigCtrl;
use srag\Plugins\M365File\Utils\M365FileTrait;
use ilM365FilePlugin;
use srag\CustomInputGUIs\M365File\FormBuilder\AbstractFormBuilder;

/**
 * Class FormBuilder
 *
 * @package srag\Plugins\M365File\Config\Form
 *
 * @author studer + raimann ag <support@studer-raimann.ch>
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class FormBuilder extends AbstractFormBuilder
{

    use M365FileTrait;

    const KEY_TENANT_NAME = "tenant_name";
    const KEY_TENANT_ID = "tenant_id";
    const KEY_CLIENT_ID = "client_id";
    const KEY_CLIENT_SECRET = "client_secret";
    const KEY_USERNAME = "username";
    const KEY_PASSWORD = "password";
    const PLUGIN_CLASS_NAME = ilM365FilePlugin::class;
    const KEY_TOKEN = "token";

    /**
     * @inheritDoc
     *
     * @param ConfigCtrl $parent
     */
    public function __construct(ConfigCtrl $parent)
    {
        parent::__construct($parent);
    }


    /**
     * @inheritDoc
     */
    protected function getButtons() : array
    {
        $buttons = [
            ConfigCtrl::CMD_UPDATE_CONFIGURE => self::plugin()->translate("save", ConfigCtrl::LANG_MODULE)
        ];

        return $buttons;
    }


    /**
     * @inheritDoc
     */
    protected function getData() : array
    {
        $data = [
            self::KEY_TENANT_NAME => self::m365File()->config()->getValue(self::KEY_TENANT_NAME),
            self::KEY_TENANT_ID => self::m365File()->config()->getValue(self::KEY_TENANT_ID),
            self::KEY_CLIENT_ID => self::m365File()->config()->getValue(self::KEY_CLIENT_ID),
            self::KEY_CLIENT_SECRET => self::m365File()->config()->getValue(self::KEY_CLIENT_SECRET),
            self::KEY_USERNAME => self::m365File()->config()->getValue(self::KEY_USERNAME),
            self::KEY_PASSWORD => self::m365File()->config()->getValue(self::KEY_PASSWORD),
        ];

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            self::KEY_TENANT_NAME => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate(self::KEY_TENANT_NAME,
                ConfigCtrl::LANG_MODULE))->withRequired(true),
            self::KEY_TENANT_ID => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate(self::KEY_TENANT_ID,
                ConfigCtrl::LANG_MODULE))->withRequired(true),
            self::KEY_CLIENT_ID => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate(self::KEY_CLIENT_ID,
                ConfigCtrl::LANG_MODULE))->withRequired(true),
            self::KEY_CLIENT_SECRET => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate(self::KEY_CLIENT_SECRET,
                ConfigCtrl::LANG_MODULE))->withRequired(true),
            self::KEY_USERNAME => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate(self::KEY_USERNAME,
                ConfigCtrl::LANG_MODULE))->withRequired(true),
            self::KEY_PASSWORD => self::dic()->ui()->factory()->input()->field()->password(self::plugin()->translate(self::KEY_PASSWORD,
                ConfigCtrl::LANG_MODULE))->withRequired(true),
        ];

        return $fields;
    }


    /**
     * @inheritDoc
     */
    protected function getTitle() : string
    {
        return self::plugin()->translate("configuration", ConfigCtrl::LANG_MODULE);
    }


    /**
     * @inheritDoc
     */
    protected function storeData(array $data)/* : void*/
    {
        self::m365File()->config()->setValue(self::KEY_TENANT_NAME, strval($data[self::KEY_TENANT_NAME]));
        self::m365File()->config()->setValue(self::KEY_TENANT_ID, strval($data[self::KEY_TENANT_ID]));
        self::m365File()->config()->setValue(self::KEY_CLIENT_ID, strval($data[self::KEY_CLIENT_ID]));
        self::m365File()->config()->setValue(self::KEY_CLIENT_SECRET, strval($data[self::KEY_CLIENT_SECRET]));
        self::m365File()->config()->setValue(self::KEY_USERNAME, strval($data[self::KEY_USERNAME]));
        self::m365File()->config()->setValue(self::KEY_PASSWORD, strval($data[self::KEY_PASSWORD]));
    }
}
