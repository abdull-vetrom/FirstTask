<?php

require_once dirname(__DIR__) . '/includes.php';

try {

    if (empty($_GET['table'])) {
        $errorMessage = 'Необходимые параметры не заданы';
        printErrorMessage(400, $errorMessage);
    }

    $primaryKeyName = 'student_id';

    if (!empty($_GET[$primaryKeyName])) {

        $primaryKeyValue = $_GET[$primaryKeyName];

        $query = file_get_contents(dirname(__DIR__) . '/sql/education/studentsExisting.sql');
        $params = [$primaryKeyName => $primaryKeyValue];
        $errorMessage = 'Нет данных о списке предметов этого студента';
        checkingDataExistence($query, $params, $errorMessage);

        $query = file_get_contents(dirname(__DIR__) . '/sql/education/ReadEducationHuman.sql');

    } else {
        $query = file_get_contents(dirname(__DIR__) . '/sql/education/ReadEducationAll.sql');
        $params = [];
    }

    $successMessage = '';
    $errorMessage = 'Ошибка выполнения запроса';
    $needResult = true;

    $result = queryExecutionCheck($query, $successMessage, $errorMessage, $params, $needResult);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['status' => 'true', 'data' => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Throwable $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}