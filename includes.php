<?php

require_once __DIR__ . '/dataForDatabaseConnection.php';

try {
    $pdo = new PDO("mysql:host=$hostname, dbname=$database, charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}

function checkingDataExistence($tableName, $attributeName, $attributeValue) {
    global $pdo;

    $query = file_get_contents(__DIR__ . '/sql/countOfLines.sql');
    $statement = $pdo->prepare($query);
    $statement->execute([
        ':tableName' => $tableName,
        ':attributeName' => $attributeName,
        ':attributeValue' => $attributeValue
    ]);

    $count = $statement->fetch(PDO::FETCH_ASSOC);
    $count = intval($count['count']);

    if ($count === 0) {
        $errorMessage = 'Данной записи не существует';
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

function getPrimaryKeyName($tableName) {
    global $pdo;

    $query = file_get_contents(__DIR__ . '/sql/getPrimaryKeyName.sql');
    $statement = $pdo->prepare($query);
    $statement->execute([':tableName' => $tableName]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row['COLUMN_NAME'];
    } else {
        $errorMessage = 'Неверное значение параметров';
        printErrorMessage(400, $errorMessage);
    }
}
