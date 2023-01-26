<?php

declare(strict_types=1);

namespace Model;

use UBS;

class Database
{
    static $connection;

    public static function getConnection(): UBS
    {
        $config = require_once(__DIR__ . '/../../config/config.php');
        
        if (!isset($connection)) {
            $connection = new UBS("mysql:host=".$config['host'].";dbname=".$config['db'], $config['user'], $config['password']);
        }

        return $connection;
    }
}
