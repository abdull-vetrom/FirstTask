<?php


use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once 'vendor/autoload.php';
require_once __DIR__ . '/dataForDB.php';

function printErrorMessage($http_response_cod, $errorMessage): void
{
    http_response_code($http_response_cod);
    echo json_encode(['status' => 'false', 'error' => $errorMessage], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function getEntityManager(): EntityManager
{

    $configuration = new Configuration;

    //caching for fast work
    $queryCache = new ArrayAdapter();
    $metadataCache = new ArrayAdapter();

    $configuration->setMetadataCache($metadataCache);
    $configuration->setQueryCache($queryCache);

    //annotations driver
    $driver = new AttributeDriver( [__DIR__ . '/Entities']);
    $configuration->setMetadataDriverImpl($driver);

    //proxy config
    $configuration->setProxyDir(__DIR__. '/var/cache');
    $configuration->setProxyNamespace('Cache\Proxies');
    $configuration->setAutoGenerateProxyClasses(false);

    return EntityManager::create(getDataForDatabaseConnection(), $configuration);
}
