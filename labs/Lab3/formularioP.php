<?php
/*
- Nombre
- Correo Electronico
- Cedula
- Edad
*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FormularioPOST</title>

        <style>
            body
            {
                background-color: rgba(93, 81, 226, 0.73);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
           }

            section
            {
                background: rgba(15, 234, 15, 0.73);
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 10px 25px rgba(37, 7, 136, 0.73);
                width: 190px;
            }

            input
            {
                padding: 10px;
                border: 3px solid #754404;
                border-radius: 8px;
                transition: 0.3s;
            }

           #Enviar
           {
            cursor: pointer;
            margin-left: 50px;
           }

           #Enviar:hover
           {
                color: red;
                background: #e6df08;

           }

        </style>

</head>
<body>
    
<section>
    <form id="fomularioP" action="salidaP.php" method="POST">
    <input type="text" name="nombre" placeholder="ingrese su nombre" required>
    <br>
    <br>
    
    <input type="email" name="CorreoElectronico" placeholder="ejemplo@gmail.com" required >
    <br>
    <br>

    <input type="text" name="Cedula" placeholder="0000-0000-0000" required> 
    <br>
    <br>

    <input type="text" name="Edad" placeholder="Edad" required > 
    <br>
    <br> 
    <input type="submit" value="Enviar" id="Enviar">
    <br>
    </form>

</section>

</body>

</html>