<?php

namespace srag\Plugins\M365File\ObjectSettings\Form;

use srag\Plugins\M365File\Utils\M365FileTrait;
use ilM365FilePlugin;
use ilObjM365File;
use ilObjM365FileGUI;
use srag\CustomInputGUIs\M365File\FormBuilder\AbstractFormBuilder;

/**
 * Class FormBuilder
 * @package srag\Plugins\M365File\ObjectSettings\Form
 * @author  studer + raimann ag <support@studer-raimann.ch>
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class FormBuilder extends AbstractFormBuilder
{

    use M365FileTrait;

    const PLUGIN_CLASS_NAME = ilM365FilePlugin::class;
    /**
     * @var ilObjM365File
     */
    protected $object;

    /**
     * @inheritDoc
     * @param ilObjM365FileGUI $parent
     * @param ilObjM365File    $object
     */
    public function __construct(ilObjM365FileGUI $parent, ilObjM365File $object)
    {
        $this->object = $object;

        parent::__construct($parent);
    }

    /**
     * @inheritDoc
     */
    protected function getButtons() : array
    {
        $buttons = [
            ilObjM365FileGUI::CMD_SETTINGS_STORE => self::plugin()->translate("save",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS),
        ];

        return $buttons;
    }

    /**
     * @inheritDoc
     */
    protected function getData() : array
    {
        $data = [
            "title" => $this->object->getTitle(),
            "description" => $this->object->getLongDescription(),
            "online" => $this->object->isOnline()
        ];

        return $data;
    }

    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            "title" => self::dic()->ui()->factory()->input()->field()->text(self::plugin()->translate("title",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS))->withRequired(true),
            "description" => self::dic()->ui()->factory()->input()->field()->textarea(self::plugin()->translate("description",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS)),
            "online" => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()->translate("online",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS)),
            "sharing_type" => self::dic()->ui()->factory()->input()->field()->radio(self::plugin()->translate("sharing_type",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS), self::plugin()->translate("sharing_type_info",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS))
                                  ->withOption("restricted", self::plugin()->translate("sharing_type_restricted",
                                      ilObjM365FileGUI::LANG_MODULE_SETTINGS))
                                  ->withOption("organization", self::plugin()->translate("sharing_type_organization",
                                      ilObjM365FileGUI::LANG_MODULE_SETTINGS))
                                  ->withOption("anonymous", self::plugin()->translate("sharing_type_anonymous",
                                      ilObjM365FileGUI::LANG_MODULE_SETTINGS)),
            "expiration" => self::dic()->ui()->factory()->input()->field()->numeric(self::plugin()->translate("expiration",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS), self::plugin()->translate("expiration_info",
                ilObjM365FileGUI::LANG_MODULE_SETTINGS))
        ];

        return $fields;
    }

    /**
     * @inheritDoc
     */
    protected function getTitle() : string
    {
        return self::plugin()->translate("settings", ilObjM365FileGUI::LANG_MODULE_SETTINGS);
    }

    /**
     * @inheritDoc
     */
    protected function storeData(array $data)/* : void*/
    {
        $this->object->setTitle(strval($data["title"]));
        $this->object->setDescription(strval($data["description"]));
        $this->object->setOnline(boolval($data["online"]));

        $this->object->update();
    }
}
