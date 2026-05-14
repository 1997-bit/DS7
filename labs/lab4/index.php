<?php
$_cookie_name = "nombre_cookie";
$_cookie_value= "valor_cookie";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab4</title>
</head>

<body>
    <section>
    <form id="fomularioP" action="bienvenida.php" method="POST">
    <input id="usuario" type="text" name="nombre" placeholder="ingrese su nombre" required>
    <br>
    <br>

    <input type="submit" value="Enviar" id="Enviar">

    <br>
    </form>

</section>
    
</body>
</html>
