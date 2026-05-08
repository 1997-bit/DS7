
<Doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body>
    <h1>Bienvenida</h1>
    <?php
    if (isset($_COOKIE['nombre_usuario'])) {
        $nombre = $_COOKIE['nombre_usuario'];
        echo "<h2>Hola, $nombre!</h2>";
        echo '<a href="eliminar_cookie.php">Salir</a>';
    } else {
        echo "<p>No se ha ingresado el nombre.</p>";
        echo '<a href="Formulario.php">Volver al formulario</a>';
    }
    ?>
</body>
</html>