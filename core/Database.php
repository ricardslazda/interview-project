<?php

namespace Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class Database
{
    protected static ?Connection $instance = null;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * @throws Exception
     */
    public static function instance(): Connection
    {
        if (self::$instance === null) {
            $connectionParams = [
                "dbname" => $_ENV["DB_NAME"],
                "user" => $_ENV["DB_USER"],
                "password" => $_ENV["DB_PASS"],
                "host" => $_ENV["DB_HOST"],
                "driver" => $_ENV["DB_DRIVER"] ?? "pdo_mysql",
            ];

            self::$instance = DriverManager::getConnection($connectionParams);
        }

        return self::$instance;
    }
}