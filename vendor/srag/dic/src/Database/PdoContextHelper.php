<?php

namespace srag\DIC\M365File\Database;

use ilDBPdo;
use ilDBPdoInterface;
use PDO;
use srag\DIC\M365File\Exception\DICException;

/**
 * Class PdoContextHelper
 *
 * @package srag\DIC\M365File\Database
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 *
 * @internal
 */
final class PdoContextHelper extends ilDBPdo
{

    /**
     * PdoContextHelper constructor
     */
    private function __construct()
    {

    }


    /**
     * @param ilDBPdoInterface $db
     *
     * @return PDO
     *
     * @throws DICException PdoContextHelper only supports ilDBPdo!
     *
     * @internal
     */
    public static function getPdo(ilDBPdoInterface $db) : PDO
    {
        if (!($db instanceof ilDBPdo)) {
            throw new DICException("PdoContextHelper only supports ilDBPdo!");
        }

        return $db->pdo;
    }


    /**
     * @inheritDoc
     */
    public function initHelpers()
    {

    }
}