<?php

require_once '../includes.php';

try {

    if (!empty($_GET["table"])) {

        $table = mysqli_real_escape_string($linkDB, $_GET["table"]);
        $primaryKeyName = getPrimaryKeyName($table);

        if (!empty($_GET[$primaryKeyName])) {

            $primaryKeyValue = intval(mysqli_real_escape_string($linkDB, $_GET[$primaryKeyName]));
            checkingDataExistence($table, $primaryKeyName, $primaryKeyValue);

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
            printErrorMessage(400, 'Ошибка выполнения запроса ' . mysqli_error($linkDB));
        }

    } else {
        printErrorMessage(400, "Параметр table не задан");
    }
} catch (Throwable $e) {
    var_dump($e -> getMessage());
    printErrorMessage(500, "Серверная ошибка");
}