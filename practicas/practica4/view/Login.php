<!DOCTYPE html>
<html>

<head>

    <title>Login</title>

</head>

<body>

    <h1>Iniciar Sesión</h1>

    <form action="../controller/LoginController.php"
        method="POST">

        <label>Usuario</label><br>

        <input type="text"
            name="usuario"
            required><br><br>

        <label>Contraseña</label><br>

        <input type="password"
            name="password"
            required><br><br>

        <button type="submit">
            Entrar
        </button>

    </form>

</body>

</html>