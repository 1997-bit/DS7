<?php
/*
- Nombre
- Correo Electronico
- Cedula
- Edad
*/



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FormularioPOST</title>
    <style>
        body {
            background-color: mediumaquamarine;
        }
    </style>
</head>
<body>

<section>
    <form id="formularioP" action="procesar.php" method="POST">

        <input type="text" name="nombre" placeholder="Nombre" required>
        <br><br>

        <input type="email" name="correo" placeholder="Correo Electronico" required>
        <br><br>

        <input type="text" name="cedula" placeholder="Cedula" required>
        <br><br>

        <input type="text" name="edad" placeholder="Edad" required>
        <br><br>

        <input type="submit" value="Enviar">

    </form>
</section>

</body>
</html>