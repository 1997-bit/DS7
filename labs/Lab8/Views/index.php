<?php
$res = file_get_contents("http://localhost/DS7/labs/Lab8/Server/Index.php");
$libros = json_decode($res, true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
        <link rel="stylesheet" href="../assets/css/style.css">
    <meta charset="UTF-8">
    <title>Libros</title>
</head>
<body>

<h2>Lista de Libros</h2>
<a href="crear.php">+ Agregar Libro</a>

<table border="1">
    <thead>
        <tr>
            <th>ID</th><th>Título</th><th>Autor</th>
            <th>Año</th><th>Género</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($libros as $l): ?>
        <tr>
            <td><?= $l['id'] ?></td>
            <td><?= $l['titulo'] ?></td>
            <td><?= $l['autor'] ?></td>
            <td><?= $l['añoPub'] ?></td>
            <td><?= $l['genero'] ?></td>
            <td>
                <a href="editar.php?id=<?= $l['id'] ?>&titulo=<?= urlencode($l['titulo']) ?>&autor=<?= urlencode($l['autor']) ?>&añoPub=<?= $l['añoPub'] ?>&genero=<?= urlencode($l['genero']) ?>">Editar</a>

                <form method="POST" action="delete.php" style="display:inline">
                    <input type="hidden" name="id" value="<?= $l['id'] ?>">
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>