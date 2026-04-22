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
           body {
                background: linear-gradient(135deg, #20c997, #0d6efd, #7b49f9, #a1d9dc);
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                }


            input
            {
                padding: 10px;
                border: 3px solid #05ed43;
                border-radius: 8px;
                transition: 0.3s;
            }

           #regresar
           {
            cursor: pointer;
            display: block;
            margin: 15px auto 0 auto;           
        }

        #regresar:hover
           {
                color: white;
                background: #0e0e0e;

           }
                h2
                {
                    text-align: center;
                    color: green;
                }


        .caja 
              {
                
                background: skyblue;
                padding: 25px;
                border-radius: 15px;
                width: 350px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.2);
              }

        </style>



</head>
        <body>

            <div class="caja">

    <h2>SalidaPOST</h2>

    <div class="dato"><strong>Nombre:</strong> <?= $nombre ?></div>
    <div class="dato"><strong>Correo:</strong> <?= $CorreoElectronico ?></div>
    <div class="dato"><strong>Cédula:</strong> <?= $cedula ?></div>
    <div class="dato"><strong>Edad:</strong> <?= $edad ?></div>

            <section>
            <form id="salidaP" action="formularioP.php" method="POST">
            <input type="submit" value="Regresar" id="regresar">
            <br>
            </form>

        </section>

            </div>
<!--
        <section>
            <form id="salidaP" action="formularioP.php" method="POST">
            <input type="submit" value="Regresar" id="regresar">
            <br>
            </form>

        </section>
-->

       </body>

</html>