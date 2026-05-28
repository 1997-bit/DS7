<?php
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/login.css" />
</head>
<body>
    <div id="Login">
        <h1>Iniciar Sesión</h1>

        <form action="../controller/LoginController.php" method="POST">

            <?php if ($error === 'invalido'): ?>
                <p class="error">Usuario o contraseña incorrectos.</p>
            <?php endif; ?>

            <label>Usuario
                <input type="text" name="usuario" required />
            </label>

            <label>Contraseña
                <input type="password" name="password" required />
            </label>

            <br>

            <button class="btn-primary" type="submit">Entrar</button>
            <button class="btn-secondary" type="button"
                onclick="window.location.href='../view/registro.php'">
                Registrarse
            </button>

        </form>
    </div>
</body>
</html>