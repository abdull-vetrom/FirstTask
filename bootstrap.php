<?php

require_once 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

/**
 * Вывод кода и сообщения об ошибке
 * @param int $httpResponseCod
 * @param string $errorMessage
 * @return void
 */
function printErrorMessage(int $httpResponseCod, string $errorMessage): void
{
    http_response_code($httpResponseCod);
    echo json_encode(['status' => 'false', 'error' => $errorMessage], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

/**
 * Проверка заданности параметра в запросе
 * @param string $requestParameterName
 * @param array $request
 * @return array
 */
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

/**
 * Получение EntityManager
 * @return EntityManager
 */
function getEntityManager(): EntityManager
{
    $configuration = new Configuration;

    $queryCache = new ArrayAdapter();
    $metadataCache = new ArrayAdapter();

    $configuration->setMetadataCache($metadataCache);
    $configuration->setQueryCache($queryCache);

    $driver = new AttributeDriver([__DIR__ . '/entities']);
    $configuration->setMetadataDriverImpl($driver);

    $configuration->setProxyDir(__DIR__ . '/var/cache');
    $configuration->setProxyNamespace('Cache\Proxies');
    $configuration->setAutoGenerateProxyClasses(true);

    $connection = DriverManager::getConnection([
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => 'resu',
        'host' => 'localhost',
        'dbname' => 'StudyPlan'
    ], $configuration);

    return new EntityManager($connection, $configuration);
}
