<?php

header('Content-Type: application/json');

require_once 'controllers/PedidoController.php';

$controller = new PedidoController();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
        $controller->procesarPedido();
        break;

    case 'GET':
        $controller->listarPedidos();
        break;

    default:
        http_response_code(405);

        echo json_encode([
            'error' => 'Metodo no permitido'
        ]);
}
