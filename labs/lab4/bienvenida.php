<?php

 $nombre = $_POST['nombre'];

setcookie("nombre_cookie", $nombre, time() + (300), "/"); 

 if(isset($_COOKIE["nombre_cookie"])) {
} else {
    echo "La cookie no está definida.";
}

$mensaje = "bienvenido " . $nombre;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bienvenida</title>
</head>
<body>

<p> 
    <?php
    echo $mensaje;
    ?>
</p>
   <form id="fomularioP" action="index.php" method="POST">
    <br>
    <input type="submit" value="Registrar" id="Enviar">

    <br>
    </form>
    



    
</body>
</html>



    
