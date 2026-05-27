<?php

 HEAD
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FormularoJSON</title>
</head>
<body>
    <section>
<div>
        <form>
                <label >
					ID:
					<input
						type="text"
						name="ID"
						placeholder="ejemplo"
						required />
				</label> 
                
                <label>
					Nombre:
					<input
						type="text"
						name="nombre"
						placeholder="PC"
						required />
				</label>

                <label>
					Marca:
					<input
						type="text"
						name="marca"
						placeholder="ACER"
						required />
				</label>

                <label>
					Precio:
					<input
						type="number"
						name="precio"
						placeholder="B/."
						required />
				</label>

                <label>
					Stock:
					<input
						type="number"
						name="Stock"
						placeholder="0"
						required />
				</label>

                <label>
					Tipo:
					<input
						type="text"
						name="tipo"
						placeholder="Electrodomestico"
						required />
				</label>


            </form>
</div>
    </section>
    
</body>
=======
require_once("../config/Json.php");

$json = new Json();

$productos = $json->leer();

?>

<!DOCTYPE html>
<html>

<head>

    <title>Inventario JSON</title>

    <link rel="stylesheet"
        href="../assets/css/base.css">

</head>

<body>

    <h1>Inventario de Productos</h1>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>

        <?php foreach ($productos as $producto) { ?>

            <tr>

                <td><?= $producto['id'] ?></td>
                <td><?= $producto['nombre'] ?></td>
                <td><?= $producto['marca'] ?></td>
                <td><?= $producto['precio'] ?></td>
                <td><?= $producto['stock'] ?></td>
                <td><?= $producto['tipo'] ?></td>

                <td>

                    <a href="Editar.php?id=<?= $producto['id'] ?>">
                        Editar
                    </a>

                </td>

            </tr>

        <?php } ?>

    </table>

    <hr>

    <h2>Agregar Producto</h2>

    <form action="../controller/ProcesarProducto.php"
        method="POST">

        <input type="hidden"
            name="accion"
            value="guardar">

        <label>ID</label><br>
        <input type="number"
            name="id"
            required><br><br>

        <label>Nombre</label><br>
        <input type="text"
            name="nombre"
            required><br><br>

        <label>Marca</label><br>
        <input type="text"
            name="marca"
            required><br><br>

        <label>Precio</label><br>
        <input type="number"
            step="0.01"
            name="precio"
            required><br><br>

        <label>Stock</label><br>
        <input type="number"
            name="stock"
            required><br><br>

        <label>Tipo</label><br>
        <input type="text"
            name="tipo"
            required><br><br>

        <button type="submit">
            Guardar
        </button>

    </form>

</body>

 fc8426a (Laboratorio # 6)
</html>