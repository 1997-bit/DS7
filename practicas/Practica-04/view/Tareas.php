<?php
require_once("../config/session.php");
require_once("../config/Json.php");

$json = new Json();
$tareas = $json->leerTareas();
$tareasUsuario = array_filter($tareas, function($t) {
    return $t['usuarioId'] == $_SESSION['usuario_id'];
});
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mis Tareas</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #007bff; color: white; }
        form { display: inline; }
        button { padding: 5px 10px; background-color: #dc3545; color: white; border: none; cursor: pointer; }
        a { color: #007bff; text-decoration: none; margin-right: 10px; }
        textarea { width: 100%; padding: 8px; }
        input[type="text"] { width: 100%; padding: 8px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mis Tareas</h1>
        <div>
            Hola <?= $_SESSION['usuario_nombre'] ?> | 
            <a href="Cerrar.php">Salir</a>
        </div>
    </div>

    <h2>Lista de Tareas</h2>
    <?php if (count($tareasUsuario) > 0): ?>
        <table>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($tareasUsuario as $t): ?>
                <tr>
                    <td><?= $t['titulo'] ?></td>
                    <td><?= $t['descripcion'] ?></td>
                    <td>
                        <form method="POST" action="../controller/TareaController.php">
                            <input type="hidden" name="accion" value="cambiar_estado">
                            <input type="hidden" name="id" value="<?= $t['id'] ?>">
                            <select name="estado" onchange="this.form.submit()">
                                <option value="por hacer" <?= $t['estado'] == 'por hacer' ? 'selected' : '' ?>>Por hacer</option>
                                <option value="hecha" <?= $t['estado'] == 'hecha' ? 'selected' : '' ?>>Hecha</option>
                            </select>
                        </form>
                    </td>
                    <td><?= $t['fechaCreacion'] ?></td>
                    <td>
                        <a href="Editar.php?id=<?= $t['id'] ?>">Editar</a>
                        <form method="POST" action="../controller/TareaController.php" style="display: inline;">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $t['id'] ?>">
                            <button onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay tareas</p>
    <?php endif; ?>

    <h2>Nueva Tarea</h2>
    <form method="POST" action="../controller/TareaController.php">
        <input type="hidden" name="accion" value="crear">
        
        <label>Título:</label><br>
        <input type="text" name="titulo" required><br>
        
        <label>Descripción:</label><br>
        <textarea name="descripcion" required></textarea><br><br>
        
        <button type="submit">Crear</button>
    </form>
</body>
</html>
