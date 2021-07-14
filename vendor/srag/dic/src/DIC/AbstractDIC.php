<?php

namespace srag\DIC\M365File\DIC;

use ILIAS\DI\Container;
use srag\DIC\M365File\Database\DatabaseDetector;
use srag\DIC\M365File\Database\DatabaseInterface;

/**
 * Class AbstractDIC
 *
 * @package srag\DIC\M365File\DIC
 */
abstract class AbstractDIC implements DICInterface
{

    /**
     * @var Container
     */
    protected $dic;


    /**
     * @inheritDoc
     */
    public function __construct(Container &$dic)
    {
        $this->dic = &$dic;
    }


    /**
     * @inheritDoc
     */
    public function database() : DatabaseInterface
    {
        return DatabaseDetector::getInstance($this->databaseCore());
    }
}
