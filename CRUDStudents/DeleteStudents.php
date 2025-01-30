<?php

require_once dirname(__DIR__) . '/includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);
    $primaryKeyName = 'student_id';

    if (count($requestArray) !== 1 or !(array_key_exists($primaryKeyName, $requestArray))) {
        $errorMessage = 'Неверное количество параметров';
        printErrorMessage(400, $errorMessage);
    }

    $primaryKeyValue = $requestArray[$primaryKeyName];

    $query = file_get_contents(dirname(__DIR__) . '/sql/students/countOfStudentsWithId.sql');
    $params = [$primaryKeyName => $primaryKeyValue];
    $errorMessage = 'Данный студент не найден';

    checkingDataExistence($query, $params, $errorMessage);

    $query = file_get_contents(dirname(__DIR__) . '/sql/students/DeleteStudents.sql');
    $successMessage = 'Данные о студенте успешно удалены';
    $errorMessage = 'Ошибка выполнения запроса';

    queryExecutionCheck($query, $successMessage, $errorMessage, $params);

} catch (Throwable $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}

