<?php

require_once __DIR__ . '/bootstrap.php';
register_shutdown_function(function (){var_dump(error_get_last()); die();});

$entityManager = getEntityManager();

$act = $_GET['act'] ?? null;
$method = $_GET['method'] ?? null;

$controllerName = 'app\\controllers\\' . ucfirst($act) . 'Controller';
$serviceName = 'app\\services\\' . ucfirst($act) . 'Service';

if (!class_exists($controllerName) || !method_exists($controllerName, $method)) {
    printErrorMessage(404, 'Переданные параметры неверные');
}

$service = new $serviceName($entityManager);
$controller = new $controllerName($service);


$data = json_decode(file_get_contents('php://input'), true) ?? [];
$fullData = $data + $_REQUEST;

$response = $controller->$method($fullData);
echo json_encode(['status' => 'true', 'data' => $response], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
