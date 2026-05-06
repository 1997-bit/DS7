
<?php
/*Grupo N:
    Gloria Moreno
    Juan Garcia
    Jonathan Gomez
    Miguel Caballero */

# Enunciado:
/*Crear una pagina con un formulario que solicite al usuario su nombre.
Crear un segundo archivo que reciba el nombre dl formulario y lo guarde en una cookie valida por 5 minutos y redirija a una pagina de bienvenida.
En la pagina de bienvanida, verificar si la cookie existe:
    Si existe, mostrar un mensaje de bienvenidad personalizado con el nombre guardado y un boton o enlace llamado "salir" que permita eliminar la cookie.
    Si no existe, mostrar un mensaje indicando que no se ha ingresado el nombre, junto con un enlace para volver al formulario. 
Crear un archivo que elimine la cookie y redirija nuevamente al formulario.
Probar el flujo completo: ingresar el nombre, ver mensaje personalizado, eliminar cookie y confirmar que se muestra el mensaje por no haber ingresado nombre.
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <h1>Ingrese su nombre</h1>
    <form action="procesar.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>