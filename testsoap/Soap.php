<?php

$cliente = new SoapClient(
    "http://localhost/DS7/testsoap/servicio.wsdl"
     );

$idProducto = 1;

try{
     $precio = $cliente->ObtenerPrecio($idProducto);
     echo "El precio del producto con ID $idProducto es: $precio";

    }catch(SoapFault $e){
        echo "Error:{$e->getMessage()}";
}
