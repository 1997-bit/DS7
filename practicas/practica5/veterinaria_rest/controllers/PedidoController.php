<?php

require_once __DIR__ . '/../models/ProductoModel.php';
require_once __DIR__ . '/../middleware/Auth.php';

class PedidoController
{
    public function procesarPedido()
    {
        // 1. Autenticacion: corta la ejecucion con 401 si el token no es valido
        $usuario = Auth::verificar();

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

        if (!is_numeric($datos['cantidad']) || (int) $datos['cantidad'] <= 0) {
            http_response_code(400);

            echo json_encode([
                'error' => 'La cantidad debe ser un numero mayor a cero'
            ]);

            return;
        }

        try {
            $soap = new SoapClient(
                null,
                [
                    'location' =>
                    'http://localhost/UTP/Des_Soft_VII/Parciales/DS7/labs/Lab9/veterinaria_soap/soap_server.php',

                    'uri' =>
                    'http://localhost/veterinaria_soap/'
                ]
            );

            $stock = $soap->consultarStock(
                $datos['producto_id']
            );
        } catch (SoapFault $e) {
            http_response_code(502);

            echo json_encode([
                'error' => 'No se pudo consultar el servicio de inventario (SOAP)'
            ]);

            return;
        }

        if ($stock < $datos['cantidad']) {
            http_response_code(400);

            echo json_encode([
                'error' => 'Stock insuficiente'
            ]);

            return;
        }

        try {
            $modelo = new ProductoModel();

            $modelo->guardarPedido(
                $datos['producto_id'],
                $datos['cantidad'],
                $usuario['id']
            );
        } catch (PDOException $e) {
            http_response_code(500);

            echo json_encode([
                'error' => 'No se pudo guardar el pedido'
            ]);

            return;
        }

        http_response_code(201);

        echo json_encode([
            'mensaje' => 'Pedido registrado correctamente'
        ]);
    }

    public function listarPedidos()
    {
        // Tambien protegido: solo un usuario autenticado ve sus pedidos
        $usuario = Auth::verificar();

        $modelo = new ProductoModel();
        $pedidos = $modelo->obtenerPedidos($usuario['id']);

        http_response_code(200);

        echo json_encode($pedidos);
    }
}
