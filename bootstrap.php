<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__ . "/src/Virgo/Tutorial/Entity/"], $isDevMode);

$conn = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/db.sqlite',
];

$entityManager = EntityManager::create($conn, $config);
