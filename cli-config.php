<?php

require 'vendor/autoload.php';
require 'core/env.php';

use Core\EntityManagerSingleton;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;

$config = new PhpFile('migrations.php');

$entityManager = EntityManagerSingleton::instance();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));