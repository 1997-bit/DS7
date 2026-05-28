<?php
//Integrantes:
//Juan Garcia
//Gloria Moreno
//Miguel Caballero
//Jonathan Gomez

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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../assets/css/base.css">
    <link rel="stylesheet" href="../assets/css/formulario.css">
</head>

<body>
<div class="page-wrapper">

    <a class="back-link" href="index.php">← Volver al inventario</a>

    <h1>Editar Producto</h1>

    <div class="card">
        <form action="../controller/ProcesarProducto.php" method="POST">

            <input type="hidden" name="accion" value="editar">

            <div class="form-grid">

                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text"
                        id="id" name="id"
                        value="<?= $productoEditar['id'] ?>"
                        readonly>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text"
                        id="nombre" name="nombre"
                        value="<?= $productoEditar['nombre'] ?>">
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text"
                        id="marca" name="marca"
                        value="<?= $productoEditar['marca'] ?>">
                </div>

                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number"
                        step="0.01"
                        id="precio" name="precio"
                        value="<?= $productoEditar['precio'] ?>">
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number"
                        id="stock" name="stock"
                        value="<?= $productoEditar['stock'] ?>">
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text"
                        id="tipo" name="tipo"
                        value="<?= $productoEditar['tipo'] ?>">
                </div>

            </div>

            <div class="form-footer">
                <button type="submit" class="btn-primary">Actualizar Producto</button>
            </div>

        </form>
    </div>

</div>
</body>

</html>