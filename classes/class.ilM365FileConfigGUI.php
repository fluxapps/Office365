<?php

require_once __DIR__ . "/../vendor/autoload.php";

use srag\Plugins\M365File\Config\ConfigCtrl;
use srag\Plugins\M365File\Utils\M365FileTrait;
use srag\DevTools\M365File\DevToolsCtrl;
use srag\DIC\M365File\DICTrait;

/**
 * Class ilM365FileConfigGUI
 *
 * Generated by SrPluginGenerator v2.8.1
 *
 * @author studer + raimann ag <support@studer-raimann.ch>
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilM365FileConfigGUI extends ilPluginConfigGUI
{

    use DICTrait;
    use M365FileTrait;

    const CMD_CONFIGURE = "configure";
    const PLUGIN_CLASS_NAME = ilM365FilePlugin::class;


    /**
     * ilM365FileConfigGUI constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function performCommand(/*string*/ $cmd)/* : void*/
    {
        $this->setTabs();

        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            case strtolower(ConfigCtrl::class):
                self::dic()->ctrl()->forwardCommand(new ConfigCtrl());
                break;

            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_CONFIGURE:
                        $this->{$cmd}();
                        break;

                    default:
                        break;
                }
                break;
        }
    }


    /**
     *
     */
    protected function configure()/* : void*/
    {
        self::dic()->ctrl()->redirectByClass(ConfigCtrl::class, ConfigCtrl::CMD_CONFIGURE);
    }


    /**
     *
     */
    protected function setTabs()/* : void*/
    {
        ConfigCtrl::addTabs();

        self::dic()->locator()->addItem(ilM365FilePlugin::PLUGIN_NAME, self::dic()->ctrl()->getLinkTarget($this, self::CMD_CONFIGURE));
    }
}