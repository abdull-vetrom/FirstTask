<?php

require_once __DIR__ . '/dataForDatabaseConnection.php';

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}

function checkingDataExistence($query, $params, $errorMessage) {
    global $pdo;

    $statement = $pdo->prepare($query);
    $statement->execute($params);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] === 0) {
        printErrorMessage(400, $errorMessage);
    }

}

function queryExecutionCheck($query, $successMessage, $errorMessage, $params = [], $needResultFlag = false) {
    global $pdo;

    try {

        $statement = $pdo->prepare($query);
        $statement->execute($params);

        if ($needResultFlag) {
            return $statement;
        } else {
            echo json_encode(['status' => 'true', 'message' => $successMessage], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

    } catch (PDOException $e) {
        printErrorMessage(400, $errorMessage);
    }
}

function printErrorMessage($http_response_code, $errorMessage) {
    http_response_code($http_response_code);
    echo json_encode(['status' => 'false', 'error' => $errorMessage], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}