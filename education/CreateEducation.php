<?php

require_once dirname(__DIR__) . '/includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);

    if (empty($requestArray)) {
        $errorMessage = 'Данные не переданы';
        printErrorMessage(400, $errorMessage);
    }

    $studentId = $requestArray['student_id'];
    $subjectName = $requestArray['subject_name'];

    $query = file_get_contents(dirname(__DIR__) . '/sql/education/whatIsSubjectId.sql');
    $successMessage = '';
    $errorMessage = 'Ошибка выполнения запроса';
    $params = ['subject_name' => $subjectName];
    $needResult = true;

    $result = queryExecutionCheck($query, $successMessage, $errorMessage, $params, $needResult);
    $result = $result->fetch(PDO::FETCH_ASSOC);
    $subjectId = $result['subject_id'];

    if (is_null($subjectId)) {
        $errorMessage = 'Данного предмета не существует';
        printErrorMessage(400, $errorMessage);
    }

    $query = file_get_contents(dirname(__DIR__) . '/sql/education/CreateEducation.sql');
    $successMessage = 'Новый предмет в расписание студента добавлен';
    $errorMessage = 'У студента уже есть данный предмет';
    $params = ['student_id' => $studentId,
               'subject_id' => $subjectId];

    queryExecutionCheck($query, $successMessage, $errorMessage, $params);


} catch (Throwable $e) {
    $errorMessage = 'Серверная ошибка';
    printErrorMessage(500, $errorMessage);
}
