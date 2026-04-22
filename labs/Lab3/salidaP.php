<?php
include "Claseprincipal.php";

    $obj = new Claseprincipal(
    $nombre = $_POST['nombre'],
    $CorreoElectronico = $_POST['CorreoElectronico'],
    $cedula = $_POST['Cedula'],
    $edad = $_POST['Edad'],
    );

    $obj->mostrarContacto();
    $obj->mostrarServidor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ResultadoPOST</title>

        <style>
            body
            {
                background: linear-gradient(135deg, #20c997, #0d6efd);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
           }

           #Enviar
           {
            margin-left: 50px;
            color: navy;
           }

        </style>

</head>
<body>
    
<section>
    <form id="salidaP" action="formularioP.php" method="POST">
    <input type="submit" value="Regresar" id="regresar">
    <br>
    </form>

</section>

</body>

</html>