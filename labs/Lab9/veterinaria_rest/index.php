<?php

header('Content-Type: application/json');

require_once 'controllers/PedidoController.php';

$controller = new PedidoController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->procesarPedido();
} else {
    http_response_code(405);

    echo json_encode([
        'error' => 'Metodo no permitido'
    ]);
}
