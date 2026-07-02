<!DOCTYPE html>
<html>

<head>
    <title>Login - Veterinaria Patitas</title>
</head>

<body>

    <h2>Iniciar Sesion</h2>

    <form id="loginForm">

        <label>Usuario:</label>
        <input type="text" id="username" required>

        <br><br>

        <label>Contraseña:</label>
        <input type="password" id="password" required>

        <br><br>

        <button type="submit">Ingresar</button>

    </form>

    <p><small>Usuarios de prueba: admin / admin123 &nbsp;|&nbsp; cliente / 123456</small></p>

    <pre id="resultado"></pre>

    <script>
        document.getElementById('loginForm')
            .addEventListener('submit', async function(e) {

                e.preventDefault();

                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;

                const respuesta = await fetch(
                    '../veterinaria_rest/login.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            username,
                            password
                        })
                    }
                );

                const datos = await respuesta.json();

                if (respuesta.ok) {
                    localStorage.setItem('token', datos.token);
                    localStorage.setItem('usuario', datos.usuario);
                    window.location.href = 'test.php';
                } else {
                    document.getElementById('resultado')
                        .textContent = JSON.stringify(datos, null, 2);
                }
            });
    </script>

</body>

</html>
