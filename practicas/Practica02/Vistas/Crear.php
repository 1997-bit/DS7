
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Assets/style.css">
    <script src="../Assets/validaciones.js"></script>
</head>
<body>
    <h2>Registrar Nuevo Libro</h2>
    <form action="../Controlador/libroController.php?action=guardar" method="POST">
        <input type="text" name="nombre" placeholder="Nombre del Libro" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="text" name="categoria" placeholder="Categoría" required>
        <input type="number" name="anio" placeholder="Año" required>
        <button type="submit">Guardar Libro</button>
    </form>
    <a href="../Index.php">Cancelar</a>
</body>
</html>