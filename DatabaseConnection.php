<?php
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
