<?php

class InventarioSOAP
{
    private $productos = [
        1 => [
            'nombre' => 'Dog Chow',
            'stock' => 20
        ],
        2 => [
            'nombre' => 'Whiskas',
            'stock' => 15
        ],
        3 => [
            'nombre' => 'Juguete para perro',
            'stock' => 10
        ]
    ];

    public function consultarStock($idProducto)
    {
        if (isset($this->productos[$idProducto])) {
            return $this->productos[$idProducto]['stock'];
        }

        return 0;
    }
}

$server = new SoapServer(
    null,
    [
        'uri' => 'http://localhost/veterinaria_soap/'
    ]
);

$server->setClass('InventarioSOAP');
$server->handle();
