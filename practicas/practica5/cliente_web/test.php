<!DOCTYPE html>
<html>

<head>
    <title>Prueba REST</title>
</head>

<body>

    <div id="sesion" style="margin-bottom: 20px;"></div>

    <h2>Enviar Pedido</h2>

    <form id="pedidoForm">

        <label>Producto ID:</label>
        <input type="number" id="producto_id" required>

        <br><br>

        <label>Cantidad:</label>
        <input type="number" id="cantidad" required>

        <br><br>

        <button type="submit">
            Enviar Pedido
        </button>

    </form>

    <p><a href="pedidos.php">Ver mis pedidos</a></p>

    <pre id="resultado"></pre>

    <script>
        const token = localStorage.getItem('token');
        const usuario = localStorage.getItem('usuario');

        // Si no hay sesion iniciada, se redirige al login
        if (!token) {
            window.location.href = 'login.php';
        }

        document.getElementById('sesion').innerHTML =
            `Sesion activa: <strong>${usuario}</strong> ` +
            `&nbsp;|&nbsp; <a href="#" id="logout">Cerrar sesion</a>`;

        document.getElementById('logout')
            .addEventListener('click', function(e) {
                e.preventDefault();
                localStorage.removeItem('token');
                localStorage.removeItem('usuario');
                window.location.href = 'login.php';
            });

        document.getElementById('pedidoForm')
            .addEventListener('submit', async function(e) {

                e.preventDefault();

                const producto_id =
                    document.getElementById('producto_id').value;

                const cantidad =
                    document.getElementById('cantidad').value;

                const respuesta = await fetch(
                    '../veterinaria_rest/index.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        },
                        body: JSON.stringify({
                            producto_id,
                            cantidad
                        })
                    }
                );

                // Si el token expiro o es invalido, el REST responde 401
                if (respuesta.status === 401) {
                    localStorage.removeItem('token');
                    localStorage.removeItem('usuario');
                    window.location.href = 'login.php';
                    return;
                }

                const datos = await respuesta.json();

                document.getElementById('resultado')
                    .textContent =
                    JSON.stringify(datos, null, 2);
            });
    </script>

</body>

</html>
