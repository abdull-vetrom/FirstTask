<?php

require_once '../includes.php';

try {

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);
    $table = 'education';

    if (!empty($requestArray)) {

        foreach ($requestArray as $key => $value) {
            $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
        }

        $studentId = $requestArray['students_id'];
        $subjectName = $requestArray['subjects_name'];

        $queryForSubjectId = "SELECT subjects_id
                              FROM subjects
                              WHERE subjects_name = '$subjectName';";
        $subjectId = queryExecutionCheck($queryForSubjectId, '', 'Значение ($subjectName) параметра (subjects_name) в таблице subjects не найдено', 1);

        if (!($subjectId = mysqli_fetch_assoc($subjectId)['subjects_id'])) {
            printErrorMessage(400, "Значение ($subjectName) параметра (subjects_name) в таблице subjects не найдено");
        }

        $query = "INSERT INTO $table (students_id, subjects_id)
                  VALUES ($studentId, $subjectId);";

        $successMessage = "Данные в таблицу $table успешно добавлены";
        $errorMessage = "Ошибка в передаваемых данных" . mysqli_error($linkDB);
        queryExecutionCheck($query, $successMessage, $errorMessage);

    } else {
        printErrorMessage(400, "Данные не переданы");
    }
} catch (Throwable $e) {
    var_dump($e -> getMessage());
    printErrorMessage(500, "Серверная ошибка");
}
