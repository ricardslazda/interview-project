<?php

namespace Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;

class EntityManagerSingleton
{
    protected static ?EntityManager $instance = null;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * @throws ORMException
     */
    public static function instance(): ?EntityManager
    {
        if (self::$instance === null) {
            $connectionParams = [
                "dbname" => $_ENV["DB_NAME"],
                "user" => $_ENV["DB_USER"],
                "password" => $_ENV["DB_PASS"],
                "host" => $_ENV["DB_HOST"],
                "driver" => $_ENV["DB_DRIVER"] ?? "pdo_mysql",
            ];

            self::$instance = EntityManager::create($connectionParams, ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/../app/models']));
        }

        return self::$instance;
    }
}