<?php
    $title = $_GET['title'];

    header('Content-type: application/json');

    if (!$title) {
        header('HTTP/1.1 404 Not Found');
        echo json_encode([
            'status' => 'incorrect request'
        ]);
        exit();
    }

    $databaseJson = file_get_contents('database.json');
    $database = json_decode($databaseJson);
    $i = 0;

    while($result = array_pop($database)) {
        if (stripos($result->title, $title) !== false) {
            $resultFinal[$i] = $result;
            $i++;
        }
    }

    if (!$resultFinal) {
        header('HTTP/1.1 404 Not Found');
        echo json_encode([
            'status' => 'game not found'
        ]);

        exit();
    }

    $resultFinal = array_reverse($resultFinal);
    echo json_encode($resultFinal);
