<?php
header('Content-Type: application/json');

$idProducto = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $client = new SoapClient(
    'http://localhost/DS7/labs/Lab9/servicios/servicios_soap.wsdl',
        ['exceptions' => true, 'trace' => true]
    );

    $stock = $client->consultarStock($idProducto);

    echo json_encode([
        'producto_id' => $idProducto,
        'stock'       => $stock
    ]);

} catch (SoapFault $e) {
    echo json_encode([
        'error'   => $e->getMessage(),
        'detalle' => $e->getCode()
    ]);
}