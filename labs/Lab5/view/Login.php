<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<form method="POST" action="../controller/Procesar.php">

    <label>
        Usuario:
        <input type="text" name="usuario" required>
    </label>

    <br><br>

    <label>
        Contraseña:
        <input type="password" name="contraseña" required>
    </label>

    <br><br>

    <button type="submit">Ingresar</button>

</form>

</body>
</html>