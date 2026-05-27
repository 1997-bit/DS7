<?php

require_once("../config/Json.php");

$json = new Json();

$productos = $json->leer();

$id = $_GET['id'];

$productoEditar = null;

foreach ($productos as $producto) {

    if ($producto['id'] == $id) {

        $productoEditar = $producto;
        break;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Producto</title>
</head>

<body>

    <h1>Editar Producto</h1>

    <form action="../controller/ProcesarProducto.php"
        method="POST">

        <input type="hidden"
            name="accion"
            value="editar">

        <label>ID</label><br>

        <input type="text"
            name="id"
            value="<?= $productoEditar['id'] ?>"
            readonly><br><br>

        <label>Nombre</label><br>

        <input type="text"
            name="nombre"
            value="<?= $productoEditar['nombre'] ?>"><br><br>

        <label>Marca</label><br>

        <input type="text"
            name="marca"
            value="<?= $productoEditar['marca'] ?>"><br><br>

        <label>Precio</label><br>

        <input type="number"
            step="0.01"
            name="precio"
            value="<?= $productoEditar['precio'] ?>"><br><br>

        <label>Stock</label><br>

        <input type="number"
            name="stock"
            value="<?= $productoEditar['stock'] ?>"><br><br>

        <label>Tipo</label><br>

        <input type="text"
            name="tipo"
            value="<?= $productoEditar['tipo'] ?>"><br><br>

        <button type="submit">
            Actualizar
        </button>

    </form>

</body>

</html>