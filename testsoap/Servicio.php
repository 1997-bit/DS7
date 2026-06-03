<?php
class ProductoServicio {
    public function obtenerPrecio($idProducto) {
        $productos = [
            1 => 19.99,
            2 => 29.99,
            3 => 9.99
        ];
        return isset($productos[$idProducto]) ? $productos[$idProducto] : -1;
    }
}

$server = new SoapServer("http://localhost/DS7/testsoap/servicio.wsdl");
$server->setClass('ProductoServicio');
$server->handle();
?>