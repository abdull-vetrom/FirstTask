<?php

require_once '../includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);
    $table = 'students';

    if (!empty($requestArray)) {

        $updateArray = [];

        foreach ($requestArray as $key => $value) {
            if ($key === 'students_id') {
                $primaryKeyName = $key;
                $primaryKeyValue = mysqli_real_escape_string($linkDB, $value);
                checkingDataExistence($table, $primaryKeyName, $primaryKeyValue);
                continue;
            }
            $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
            $updatingPair = $key . ' = ' . "\"$value\"";
            $updateArray[] = $updatingPair;
        }

        $updateString = implode(', ', $updateArray);

        $query = "UPDATE $table
                  SET $updateString
                  WHERE $primaryKeyName = $primaryKeyValue;";

        queryExecutionCheck($query, 'Данные о студенте успешно обновлены', 'Ошибка выполнения запроса' . mysqli_error($linkDB));

    } else {
        printErrorMessage(400, 'Данные не заполнены');
    }
} catch (Throwable $e) {
    var_dump($e -> getMessage());
    printErrorMessage(500, 'Серверная ошибка');
}