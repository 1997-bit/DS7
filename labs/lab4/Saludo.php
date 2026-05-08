<?php

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