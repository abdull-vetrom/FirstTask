<?php


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once 'vendor/autoload.php';
require_once __DIR__ . '/dataForDB.php';

function printErrorMessage(int $http_response_cod, string $errorMessage): void
{
    http_response_code($http_response_cod);
    echo json_encode(['status' => 'false', 'error' => $errorMessage], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function checkParameterExistence(string $requestParameterName, array $request): array
{
    try {

        $requestParameterValue = $request[$requestParameterName]
        ?: throw new Exception();

    } catch (Throwable) {
        printErrorMessage(400, 'Необходимый параметр не задан');
    }

    return [
        $requestParameterName => $requestParameterValue
    ];

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

    $connection = DriverManager::getConnection([
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => 'resu',
        'host' => 'localhost',
        'dbname' => 'StudyPlan'
    ], $configuration);

    return new EntityManager($connection, $configuration);
}
