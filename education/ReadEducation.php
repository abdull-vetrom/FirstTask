<?php

require_once '../includes.php';

try {

    if (!empty($_GET['table'])) {

        $table = mysqli_real_escape_string($linkDB, $_GET['table']);
        $primaryKeyName = getPrimaryKeyName($table);

        if (!empty($_GET[$primaryKeyName])) {

            $primaryKeyValue = intval(mysqli_real_escape_string($linkDB, $_GET[$primaryKeyName]));
            checkingDataExistence($table, $primaryKeyName, $primaryKeyValue);

            $query = "SELECT stu.students_id, stu.students_name, stu.students_surname, stu.students_lastname, stu.students_group, sub.subjects_id, sub.subjects_name
                      FROM students stu, subjects sub, education edu
                      WHERE stu.students_id = edu.students_id AND
                            sub.subjects_id = edu.subjects_id AND
                            edu.students_id = $primaryKeyValue";

        } else {
            $query = "SELECT stu.students_id, stu.students_name, stu.students_surname, stu.students_lastname, stu.students_group, sub.subjects_id, sub.subjects_name
                      FROM students stu, subjects sub, education edu
                      WHERE stu.students_id = edu.students_id AND
                            sub.subjects_id = edu.subjects_id";
        }

        $result = queryExecutionCheck($query, '', 'Ошибка выполнения запроса', 1);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(['status' => 'true', 'data' => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    } else {
        printErrorMessage(400, 'Необходимые параметры не заданы');
    }
} catch (Throwable $e) {
    var_dump($e -> getMessage());
    printErrorMessage(500, 'Серверная ошибка');
}