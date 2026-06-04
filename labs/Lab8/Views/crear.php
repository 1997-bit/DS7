<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libro = json_encode([
        "titulo"  => $_POST['titulo'],
        "autor"   => $_POST['autor'],
        "añoPub"  => $_POST['añoPub'],
        "genero"  => $_POST['genero']
    ]);

    $opciones = [
        "http" => [
            "method"  => "POST",
            "header"  => "Content-Type: application/json",
            "content" => $libro
        ]
    ];
    $contexto = stream_context_create($opciones);
    file_get_contents("http://localhost/DS7/labs/Lab8/Server/Index.php", false, $contexto);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Libro</title>
</head>
<body>

<h2>Registrar Libro</h2>
<form method="POST">
    <label>Título:  <input type="text"   name="titulo" required></label><br><br>
    <label>Autor:   <input type="text"   name="autor"  required></label><br><br>
    <label>Año:     <input type="number" name="añoPub" required></label><br><br>
    <label>Género:  <input type="text"   name="genero" required></label><br><br>
    <button type="submit">Guardar</button>
    <a href="index.php">Cancelar</a>
</form>

</body>
</html>