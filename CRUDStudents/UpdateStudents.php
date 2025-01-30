<?php

require_once dirname(__DIR__) . '/includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);
    $primaryKeyName = 'students_id';

    if (empty($requestArray)) {
        $errorMessage = 'Данные не заполнены';
        printErrorMessage(400, $errorMessage);
    }

    $primaryKeyValue = $requestArray[$primaryKeyName];

    $query = file_get_contents(dirname(__DIR__) . '/sql/students/countOfStudentsWithId.sql');
    $errorMessage = 'Данный студент не найден';
    $params = [$primaryKeyName => $primaryKeyValue];

    checkingDataExistence($query, $params, $errorMessage);

    $query = file_get_contents(dirname(__DIR__) . '/sql/students/UpdateStudents.sql');
    $successMessage = 'Данные о студенте успешно обновлены';
    $errorMessage = 'Ошибка выполнения запроса';
    queryExecutionCheck($query, $successMessage, $errorMessage, $requestArray);


} catch (Throwable $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}