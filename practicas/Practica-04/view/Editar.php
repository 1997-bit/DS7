<?php
require_once("../config/session.php");
require_once("../config/Json.php");

$json = new Json();
$tareas = $json->leerTareas();
$id = $_GET['id'];
$tarea = null;

foreach ($tareas as $t) {
    if ($t['id'] == $id && $t['usuarioId'] == $_SESSION['usuario_id']) {
        $tarea = $t;
        break;
    }
}

if (!$tarea) {
    header("Location: Tareas.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        form { max-width: 500px; }
        input, textarea { width: 100%; padding: 8px; margin: 8px 0; }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <a href="Tareas.php">← Volver</a>
    
    <h1>Editar Tarea</h1>
    
    <form method="POST" action="../controller/TareaController.php">
        <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
        
        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= $tarea['titulo'] ?>" required><br>
        
        <label>Descripción:</label><br>
        <textarea name="descripcion" required><?= $tarea['descripcion'] ?></textarea><br>
        
        <p>Estado: <strong><?= $tarea['estado'] ?></strong></p>
        <p>Fecha: <?= $tarea['fechaCreacion'] ?></p>
        
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
