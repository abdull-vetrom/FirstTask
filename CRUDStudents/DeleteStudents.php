<?php

try {

    require_once '../DatabaseConnection.php';

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);

    if (!empty($requestArray)) {

        $value = mysqli_real_escape_string($linkDB, $requestArray['students_id']);

        $query = "DELETE FROM students WHERE students_id = $value";

        if (mysqli_query($linkDB, $query)) {
            echo json_encode(['status' => 'success', 'message' => 'Данные о студенте удалены'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Ошибка в передаваемых данных' . mysqli_error($linkDB)], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Данные не заполнены'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }
} catch (Throwable $e) {
    var_dump($e -> getMessage());
    die;
}

