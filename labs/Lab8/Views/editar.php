<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libro = json_encode([
        "id"     => $_POST['id'],
        "titulo" => $_POST['titulo'],
        "autor"  => $_POST['autor'],
        "añoPub" => $_POST['añoPub'],
        "genero" => $_POST['genero']
    ]);

    $opciones = [
        "http" => [
            "method"  => "PUT",
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
        <link rel="stylesheet" href="../assets/css/style.css">

    <meta charset="UTF-8">
    <title>Editar Libro</title>
</head>
<body>

<h2>Editar Libro</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

    <label>Título:  <input type="text"   name="titulo" value="<?= htmlspecialchars($_GET['titulo']) ?>" required></label><br><br>
    <label>Autor:   <input type="text"   name="autor"  value="<?= htmlspecialchars($_GET['autor'])  ?>" required></label><br><br>
    <label>Año:     <input type="number" name="añoPub" value="<?= $_GET['añoPub'] ?>"                   required></label><br><br>
    <label>Género:  <input type="text"   name="genero" value="<?= htmlspecialchars($_GET['genero']) ?>" required></label><br><br>
    <button type="submit">Actualizar</button>
    <a href="index.php">Cancelar</a>
</form>

</body>
</html>