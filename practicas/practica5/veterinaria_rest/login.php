<?php

header('Content-Type: application/json');

require_once 'controllers/LoginController.php';

$controller = new LoginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login();
} else {
    http_response_code(405);

    echo json_encode([
        'error' => 'Metodo no permitido'
    ]);
}
