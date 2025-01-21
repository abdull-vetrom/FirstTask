<?php

//require_once 'DatabaseConnection.php';

$hostname = "localhost";
$username = "root";
$password = "resu";
$database = "StudyPlan";
$linkDB = mysqli_connect($hostname, $username, $password, $database);

if (!$linkDB) {
    http_response_code(500);
    echo json_encode(['error' => "Ошибка подлкючения к базе данных " . mysqli_connect_error()], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}
mysqli_set_charset($linkDB,"utf8");

function checkingDataExistence($tableName, $variableName, $variableValue) {
    global $linkDB;

    $query = "SELECT COUNT(*) AS count
              FROM $tableName
              WHERE $variableName = $variableValue;";

    $resultCheckQuery = mysqli_query($linkDB, $query);
    $countRowResultCheckQuery = mysqli_fetch_assoc($resultCheckQuery);

    if ($countRowResultCheckQuery["count"] == 0) {
        printErrorMessage(400, "Записи со значеним ($variableValue) переменной ($variableName) в таблице ($tableName) не существует");
    }
}

function queryExecutionCheck($query, $successMessage, $errorMessage, $needResultFlag = 0) {
    global $linkDB;
    if ($result = mysqli_query($linkDB, $query)) {

        if ($needResultFlag) {
            return $result;
        } else {
            echo json_encode(['status' => 'true', 'message' => $successMessage], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

    } else {
        printErrorMessage(400, $errorMessage);
    }
}

function printErrorMessage($http_response_code, $errorMessage) {
    http_response_code($http_response_code);
    echo json_encode(['status' => 'false', 'error' => $errorMessage], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

function getPrimaryKeyName($tableName) {
    global $linkDB, $database;
    $query = "SELECT COLUMN_NAME
              FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
              WHERE TABLE_SCHEMA = '$database' AND
                    TABLE_NAME = '$tableName' AND
                    CONSTRAINT_NAME = 'PRIMARY';";

    if ($result = mysqli_query($linkDB, $query)) {
        $row = mysqli_fetch_assoc($result);
        return $row['COLUMN_NAME'];
    } else {
        printErrorMessage(400, "Имя таблицы задано неверно");
    }
}

