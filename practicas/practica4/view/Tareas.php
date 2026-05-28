<?php

require_once("../config/Session.php");
require_once("../config/Json.php");

$json = new Json();
$tareas = $json->leer("../assets/tareas.json");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tareas</title>
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/tareas.css" />
</head>
<body>
    <div class="container">

        <div class="topbar">
            <h1>Lista de Tareas</h1>
            <a href="../controller/LogoutController.php">Cerrar Sesión</a>
        </div>

        <p class="bienvenida">Bienvenido: <strong><?= $_SESSION['usuario'] ?></strong></p>

        <div class="nueva-tarea">
            <h2>Nueva Tarea</h2>
            <form action="../controller/TareaController.php" method="POST">
                <input type="hidden" name="accion" value="crear">
                <input type="text" name="descripcion" placeholder="Descripción de la tarea..." required>
                <button type="submit">Guardar</button>
            </form>
        </div>

        <h2 style="margin-bottom: 1rem; font-size: 1.1rem; color: #444;">Mis Tareas</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($tareas as $tarea): ?>
                <?php if ($tarea['usuario'] == $_SESSION['usuario']): ?>
                    <tr>
                        <td><?= $tarea['id'] ?></td>
                        <td><?= $tarea['descripcion'] ?></td>
                        <td><?= $tarea['estado'] ?></td>
                        <td>
                            <form action="../controller/TareaController.php" method="POST" style="display:inline;">
                                <input type="hidden" name="accion" value="estado">
                                <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                                <button class="btn-estado" type="submit">Cambiar Estado</button>
                            </form>

                            <form action="../controller/TareaController.php" method="POST" style="display:inline;">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                                <button class="btn-eliminar" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>

        </table>

    </div>
</body>
</html>