<?php

require_once __DIR__ . '/../models/ProductoModel.php';

class PedidoController
{
    public function procesarPedido()
    {
        $datos = json_decode(
            file_get_contents("php://input"),
            true
        );

        if (
            !isset($datos['producto_id']) ||
            !isset($datos['cantidad'])
        ) {
            http_response_code(400);

            echo json_encode([
                'error' => 'Datos incompletos'
            ]);

            return;
        }

        $soap = new SoapClient(
            null,
            [
                'location' =>
                'http://localhost/DS7/labs/Lab9/veterinaria_soap/soap_server.php',

                'uri' =>
                'http://localhost/veterinaria_soap/'
            ]
        );

        $stock = $soap->consultarStock(
            $datos['producto_id']
        );

        if ($stock < $datos['cantidad']) {
            http_response_code(400);

            echo json_encode([
                'error' => 'Stock insuficiente'
            ]);

            return;
        }

        $modelo = new ProductoModel();

        $modelo->guardarPedido(
            $datos['producto_id'],
            $datos['cantidad']
        );

        http_response_code(201);

        echo json_encode([
            'mensaje' => 'Pedido registrado correctamente'
        ]);
    }
}
