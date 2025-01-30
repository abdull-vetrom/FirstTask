<?php

require_once dirname(__DIR__) . '/includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);

    if (empty($requestArray)) {
        $errorMessage = 'Данные не переданы';
        printErrorMessage(400, $errorMessage);
    }

    $query = file_get_contents(dirname(__DIR__) . '/sql/students/CreateStudents.sql');
    $successMessage = 'Новый студент успешно добавлен';
    $errorMessage = 'Ошибка в передаваемых данных';

    queryExecutionCheck($query, $successMessage, $errorMessage, $requestArray);

} catch (Throwable $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}
