<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

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

if (isset($_GET["table"]) and $_GET["table"] != "") {

    $table = mysqli_real_escape_string($linkDB, $_GET["table"]);

    $checkTableQuery = "SELECT COUNT(*) as count FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = $database AND TABLE_NAME = $table";
//    checkingDataExistence($checkTableQuery, $table);


    if (isset($_GET["students_id"])) {

        if($_GET["students_id"] != "") {

            $students_id = intval(mysqli_real_escape_string($linkDB, $_GET["students_id"]));

            $checkStudents_idQuery = "SELECT COUNT(*) as count FROM $table WHERE students_id = $students_id";
            checkingDataExistence($checkStudents_idQuery, $table);

            $query = "SELECT * FROM $table WHERE students_id = $students_id";
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
            echo json_encode(['error' => 'Параметр students_id не задан'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    } else {
        $query = "SELECT * FROM $table";
        $result = mysqli_query($linkDB,$query);

        if ($result) {
            $data = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            echo json_encode(['status' => true,'data' => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Ошибка выполнения запроса ' . mysqli_error($linkDB)], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }

} else {
    http_response_code(400);
    echo json_encode(['error' => 'Параметр table не задан'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

function checkingDataExistence($query, $name) {
    global $linkDB;
    $resultCheckQuery = mysqli_query($linkDB, $query);
    $countRowResultCheckQuery = mysqli_fetch_assoc($resultCheckQuery);
    if ($countRowResultCheckQuery["count"] == 0) {
        http_response_code(400);
        echo json_encode(['error' => "Неправильное имя $name"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
}


