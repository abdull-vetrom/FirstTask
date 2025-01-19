<?php
try {

    require_once '../DatabaseConnection.php';

    $input = file_get_contents('php://input');
    $requestArray = json_decode($input, true);

    if (!empty($requestArray)) {

        $updateArray = [];

        foreach ($requestArray as $key => $value) {
            if ($key == 'students_id') {
                $studentsId = $value;
                continue;
            }
            $requestArray[$key] = mysqli_real_escape_string($linkDB, $value);
            $updatingPair = $key . ' = ' . "\"$value\"";
            $updateArray[] = $updatingPair;
        }

        if (!$studentsId) {
            http_response_code(400);
            echo json_encode(['error' => 'Не один студент не выбран'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit;
        }

        $updateString = implode(', ', $updateArray);

        $query = "UPDATE students SET $updateString WHERE students_id = $studentsId";

        if (mysqli_query($linkDB, $query)) {
            echo json_encode(['status' => 'success', 'message' => 'Данные о студенте обнавлены'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
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