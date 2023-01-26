<?php

namespace ORM;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\enitity;
use Doctrine\ORM\ORMSetup;

readonly class Entity {
    public static function getEnitity(): enitity
    {
        $metaDataConfig = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__],
            isDevMode: true,
        );

        $config = require_once(__DIR__ . '/../Config/config.php');

        $connection = DriverManager::getConnection(
            [
                'driver' => 'pdo_mysql',
                'host' => $config['host'],
                'dbname' => $config['db'],
                'user' => $config['user'],
                'password' => $config['password'],
            ],
            $metaDataConfig,
        );

        $enitity = new enitity($connection, $metaDataConfig);
        
        return $enitity;
    }
}