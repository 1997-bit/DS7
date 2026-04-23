<?php 
    require_once __DIR__ . "/../Models/Libro.php"; // Asegura la ruta correcta al modelo
    $libros = (new Libro())->listar(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>
    <h1>Administración de Libros</h1>
    <a href="Vistas/Crear.php">Añadir Nuevo Libro</a>
    <table>
        <thead><tr><th>Nombre</th><th>Autor</th><th>Categoría</th><th>Año</th><th>Acciones</th></tr></thead>
        <tbody>
            <?php foreach ($libros as $l): ?>
            <tr>
                <!-- Uso obligatorio de htmlspecialchars() para evitar XSS  -->
                <td><?php echo htmlspecialchars($l['Nombre']); ?></td>
                <td><?php echo htmlspecialchars($l['Autor']); ?></td>
                <td><?php echo htmlspecialchars($l['Categoria']); ?></td>
                <td><?php echo $l['Año']; ?></td>
                <td>
                    <a href="Vistas/Editar.php?id=<?php echo $l['id']; ?>">Editar</a>
                    <a href="Controlador/libroController.php?action=eliminar&id=<?php echo $l['id']; ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>