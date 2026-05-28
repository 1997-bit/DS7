<?php

require_once("../model/Producto.php");
require_once("../config/Json.php");

$json = new Json();

$productos = $json->leer();

$accion = $_POST['accion'];

if ($accion == "guardar") {

    $producto = new Producto(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['marca'],
        $_POST['precio'],
        $_POST['stock'],
        $_POST['tipo']
    );

    $productos[] = $producto->toArray();

    $json->guardar($productos);
}

if ($accion == "editar") {

    foreach ($productos as &$producto) {

        if ($producto['id'] == $_POST['id']) {

            $producto['nombre'] = $_POST['nombre'];
            $producto['marca'] = $_POST['marca'];
            $producto['precio'] = $_POST['precio'];
            $producto['stock'] = $_POST['stock'];
            $producto['tipo'] = $_POST['tipo'];

            break;
        }
    }

    $json->guardar($productos);
}

header("Location: ../view/Formulario.php");
