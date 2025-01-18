<?php
$linkDB = mysqli_connect("localhost","root","resu","StudyPlan");

if (!$linkDB) {
    http_response_code(500);
    echo json_encode(['error' => "Ошибка подлкючения к базе данных " . mysqli_connect_error()], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

mysqli_set_charset($linkDB,"utf8");

if (isset($_GET["table"])) {
    if ($_GET["table"] != "") {

        $table = $_GET["table"];

        $query = "SELECT * FROM `$table`";
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
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Параметр table не задан'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

} else {
    http_response_code(400);
    json_encode(['error' => 'Параметр table не передан']);
}
