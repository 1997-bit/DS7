<?php

require_once("../config/Session.php");
require_once("../config/Json.php");

$json = new Json();

$tareas = $json->leer("../assets/tareas.json");

?>

<!DOCTYPE html>
<html>

<head>

    <title>Tareas</title>

</head>

<body>

    <h1>Lista de Tareas</h1>

    <p>
        Bienvenido:
        <?= $_SESSION['usuario'] ?>
    </p>

    <a href="../controller/LogoutController.php">
        Cerrar Sesión
    </a>

    <hr>

    <h2>Nueva Tarea</h2>

    <form action="../controller/TareaController.php"
        method="POST">

        <input type="hidden"
            name="accion"
            value="crear">

        <input type="text"
            name="descripcion"
            required>

        <button type="submit">
            Guardar
        </button>

    </form>

    <hr>

    <h2>Mis Tareas</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($tareas as $tarea) { ?>

            <?php if ($tarea['usuario'] == $_SESSION['usuario']) { ?>

                <tr>

                    <td><?= $tarea['id'] ?></td>

                    <td><?= $tarea['descripcion'] ?></td>

                    <td><?= $tarea['estado'] ?></td>

                    <td>

                        <form action="../controller/TareaController.php"
                            method="POST"
                            style="display:inline;">

                            <input type="hidden"
                                name="accion"
                                value="estado">

                            <input type="hidden"
                                name="id"
                                value="<?= $tarea['id'] ?>">

                            <button type="submit">
                                Cambiar Estado
                            </button>

                        </form>

                        <form action="../controller/TareaController.php"
                            method="POST"
                            style="display:inline;">

                            <input type="hidden"
                                name="accion"
                                value="eliminar">

                            <input type="hidden"
                                name="id"
                                value="<?= $tarea['id'] ?>">

                            <button type="submit">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            <?php } ?>

        <?php } ?>

    </table>

</body>

</html>