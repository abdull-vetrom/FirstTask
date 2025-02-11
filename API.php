<?php

require_once __DIR__ . '/bootstrap.php';

$entityManager = getEntityManager();

$act = $_GET['act'] ?? null;
$method = $_GET['method'] ?? null;

$controllerName = 'app\\controllers\\' . ucfirst($act) . 'Controller';
if (!class_exists($controllerName) || !method_exists($controllerName, $method)) {
    printErrorMessage(400, 'Переданные параметры неверные');
}
$controller = new $controllerName($entityManager);
$response = $controller->$method($_REQUEST);
echo json_encode(['status' => 'true', 'data' => $response], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
