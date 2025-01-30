<?php

require_once dirname(__DIR__) . '/includes.php';

try {

    if (empty($_GET['table']) or $_GET['table'] !== 'subjects') {
        $errorMessage = 'Необходимые параметры не заданы или заданы неверно';
        printErrorMessage(400, $errorMessage);
    }

    $primaryKeyName = 'subject_id';

    if (!empty($_GET[$primaryKeyName])) {

        $primaryKeyValue = $_GET[$primaryKeyName];
        $params = [$primaryKeyName => $primaryKeyValue];
        $query = file_get_contents(dirname(__DIR__) . '/sql/subjects/countOfSubjectsWithId.sql');
        $errorMessage = 'Данный предмет не найден';

        checkingDataExistence($query, $params, $errorMessage);

        $query = file_get_contents(dirname(__DIR__) . '/sql/subjects/ReadSubjectsItem.sql');

    } else {
        $query = file_get_contents(dirname(__DIR__) . '/sql/subjects/ReadSubjectsAll.sql');
        $params = [];
    }

    $needResult = true;
    $successMessage = '';
    $errorMessage = 'Ошибка выполнения запроса';
    $result = queryExecutionCheck($query, $successMessage, $errorMessage, $params, $needResult);

    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['status' => 'true', 'data' => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Throwable $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}