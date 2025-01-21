<?php

require_once '../includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);
    $table = 'subjects';

    if (!empty($requestArray)) {

        foreach ($requestArray as $key => $value) {
            $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
        }

        $columns = implode(', ', array_keys($requestArray));
        $values = '"' . implode('", "', array_values($requestArray)) . '"';

        $query = "INSERT INTO $table ($columns)
                  VALUES ($values);";

        $successMessage = "Данные в таблицу $table успешно добавлены";
        $errorMessage = "Ошибка в передаваемых данных" . mysqli_error($linkDB);
        queryExecutionCheck($query, $successMessage, $errorMessage);

    } else {
        printErrorMessage(400, "Данные не переданы");
    }
} catch (Throwable $e) {
    var_dump($e -> getMessage());
    printErrorMessage(400, "Серверная ошибка");
}
