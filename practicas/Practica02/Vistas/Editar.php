<?php
require_once __DIR__ . "/../Models/Libro.php"; // Asegura la ruta correcta al modelo

// 1. Obtiene el ID de la URL y valida su existencia
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../Index.php");
    exit;
}

// Busca los datos actuales del libro
$modelo = new Libro();
$libro = $modelo->obtenerPorId($id);

if (!$libro) {
    echo "Libro no encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="../Assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Editar Información del Libro</h2>
        <!-- El action apunta al controlador con la acción 'editar' -->
        <form id="formLibro" action="../Controlador/libroController.php?action=editar" method="POST">
            <!-- Campo oculto para enviar el ID sin que el usuario lo edite -->
            <input type="hidden" name="id" value="<?php echo $libro['id']; ?>">

            <label>Nombre del Libro:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($libro['Nombre']); ?>" required>

            <label>Autor:</label>
            <input type="text" name="autor" id="autor" value="<?php echo htmlspecialchars($libro['Autor']); ?>" required>

            <label>Categoría:</label>
            <input type="text" name="categoria" id="categoria" value="<?php echo htmlspecialchars($libro['Categoria']); ?>" required>

            <label>Año de Publicación:</label>
            <input type="number" name="anio" id="anio" value="<?php echo $libro['Año']; ?>" required>

            <div class="buttons">
                <button type="submit" class="btn-save">Actualizar Cambios</button>
                <a href="../Index.php" class="btn-cancel">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Vinculación del JavaScript para validaciones -->
    <script src="../Assets/validaciones.js"></script>
</body>
</html>