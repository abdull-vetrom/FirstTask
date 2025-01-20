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

function creating ($tableName) {
    global $linkDB;
    try {

        $input = file_get_contents('php://input');
        $requestArray = json_decode($input, true);

        if (!empty($requestArray)) {

            foreach ($requestArray as $key => $value) {
                $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
            }

            $columns = implode(', ', array_keys($requestArray));
            $values = '"' . implode('", "', array_values($requestArray)) . '"';

            $query = "INSERT INTO $tableName ($columns)
                      VALUES ($values);";

            if (mysqli_query($linkDB, $query)) {
                echo json_encode(['status' => 'success', 'message' => "Данные в таблицу $tableName успешно добавлены"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Ошибка в передаваемых данных' . mysqli_error($linkDB)], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Данные не заполнены'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
    } catch (Throwable $e) {
        var_dump($e -> getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Серверная ошибка'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die;
    }
}

function reading () {
    global $database, $linkDB;
    try {

        if (!empty($_GET["table"])) {

            $table = mysqli_real_escape_string($linkDB, $_GET["table"]);

            $query = "SELECT COLUMN_NAME
                      FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                      WHERE TABLE_SCHEMA = '$database' AND
                            TABLE_NAME = '$table' AND
                            CONSTRAINT_NAME = 'PRIMARY';";

            if ($result = mysqli_query($linkDB, $query)) {
                $row = mysqli_fetch_assoc($result);
                $primaryKeyName = $row['COLUMN_NAME'];
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Имя таблицы задано неверно']);
                exit;
            }

            if (!empty($_GET[$primaryKeyName])) {

                $primaryKeyValue = intval(mysqli_real_escape_string($linkDB, $_GET[$primaryKeyName]));

                $checkPrimaryKeyValue = "SELECT COUNT(*) AS count
                                         FROM $table
                                         WHERE $primaryKeyName = $primaryKeyValue;";
                checkingDataExistence($checkPrimaryKeyValue, $primaryKeyName);

                $query = "SELECT *
                          FROM $table
                          WHERE $primaryKeyName = $primaryKeyValue;";

            } else {
                $query = "SELECT *
                          FROM $table;";
            }

            $result = mysqli_query($linkDB, $query);

            if ($result) {

                $data = [];

                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }

                echo json_encode(['status' => 'True', 'data' => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Ошибка выполнения запроса ' . mysqli_error($linkDB)], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }

        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Параметр table не задан'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    } catch (Throwable $e) {
        var_dump($e -> getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Серверная ошибка'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die;
    }

}

function updating ($tableName) {
    global $linkDB;
    try {

        $input = file_get_contents('php://input');
        $requestArray = json_decode($input, true);

        if (!empty($requestArray)) {

            $updateArray = [];

            foreach ($requestArray as $key => $value) {
                if ($key == 'students_id' or $key == 'subjects_id') {
                    $primaryKeyName = $key;
                    $primaryKeyValue = $value;
                    continue;
                }
                $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
                $updatingPair = $key . ' = ' . "\"$value\"";
                $updateArray[] = $updatingPair;
            }

            if (!$primaryKeyValue) {
                http_response_code(400);
                echo json_encode(['error' => "Не один субъект из таблицы $tableName не выбран"], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                exit;
            }

            $updateString = implode(', ', $updateArray);

            $query = "UPDATE $tableName
                      SET $updateString
                      WHERE $primaryKeyName = $primaryKeyValue;";

            if (mysqli_query($linkDB, $query)) {
                echo json_encode(['status' => 'success', 'message' => "Данные в таблице $tableName обновлены"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Ошибка в передаваемых данных' . mysqli_error($linkDB)], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Данные не заполнены'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
    } catch (Throwable $e) {
        var_dump($e -> getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Серверная ошибка'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die;
    }
}

function deleting ($tableName) {
    global $linkDB;
    try {

        $input = file_get_contents('php://input');
        $requestArray = json_decode($input, true);

        if (count($requestArray) === 1) {

            $primaryKeyName = array_keys($requestArray)[0];
            $primaryKeyValue = mysqli_real_escape_string($linkDB, $requestArray[$primaryKeyName]);

            $query = "DELETE FROM $tableName
                      WHERE $primaryKeyName = $primaryKeyValue;";

            if (mysqli_query($linkDB, $query)) {
                echo json_encode(['status' => 'success', 'message' => 'Данные о студенте удалены'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Ошибка в передаваемых данных' . mysqli_error($linkDB)], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Неверное количество параметров'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
    } catch (Throwable $e) {
        var_dump($e -> getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Серверная ошибка'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die;
    }
}

function checkingDataExistence($query, $name) {
    global $linkDB;
    $resultCheckQuery = mysqli_query($linkDB, $query);
    $countRowResultCheckQuery = mysqli_fetch_assoc($resultCheckQuery);
    if ($countRowResultCheckQuery["count"] == 0) {
        http_response_code(400);
        echo json_encode(['error' => "Неправильное значение переменной $name"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}
