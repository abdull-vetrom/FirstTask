<?php

require_once '../includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);
    $table = 'students';

    if (!empty($requestArray)) {

        foreach ($requestArray as $key => $value) {
            $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
        }

        $values = '"' . implode('", "', array_values($requestArray)) . '"';

        $query = "INSERT INTO $table
                  VALUES ($values)";

        $successMessage = 'Новый студент успешно добавлен';
        $errorMessage = 'Ошибка в передаваемых данных';
        queryExecutionCheck($query, $successMessage, $errorMessage);

    } else {
        printErrorMessage(400, 'Данные не переданы');
    }
} catch (Throwable $e) {
    printErrorMessage(500, 'Серверная ошибка');
}
