<?php
try {
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
    require_once '../DatabaseConnection.php';

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);

    if (!empty($requestArray)) {

        foreach ($requestArray as $key => $value) {
            $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
        }

        $columns = implode(', ', array_keys($requestArray));
        $values = '"' . implode('", "', array_values($requestArray)) . '"';

        $query = "INSERT INTO students ($columns) VALUES ($values)";

        if (mysqli_query($linkDB, $query)) {
            echo json_encode(['status' => 'success', 'message' => 'Студент успешно добавлен'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
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
