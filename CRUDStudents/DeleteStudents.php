<?php

require_once '../includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);
    $table = 'students';
    $primaryKeyName = getPrimaryKeyName($table);

    if (count($requestArray) === 1 and $primaryKeyName === 'students_id') {

        $primaryKeyValue = mysqli_real_escape_string($linkDB, $requestArray[$primaryKeyName]);
        checkingDataExistence($table, $primaryKeyName, $primaryKeyValue);

        $query = "DELETE FROM $table
                  WHERE $primaryKeyName = $primaryKeyValue;";

        queryExecutionCheck($query, 'Данные о студенте успешно удалены', 'Ошибка выполнения запроса');

    } else {
        printErrorMessage(400, 'Неверное количество параметров');
    }
} catch (Throwable $e) {
    printErrorMessage(500, 'Серверная ошибка');
}

