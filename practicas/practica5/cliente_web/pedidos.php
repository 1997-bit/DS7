<!DOCTYPE html>
<html>

<head>
    <title>Mis Pedidos</title>
</head>

<body>

    <div id="sesion" style="margin-bottom: 20px;"></div>

    <h2>Mis Pedidos</h2>

    <p><a href="test.php">← Volver a enviar pedido</a></p>

    <table border="1" cellpadding="6" id="tablaPedidos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto ID</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <pre id="resultado"></pre>

    <script>
        const token = localStorage.getItem('token');
        const usuario = localStorage.getItem('usuario');

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

        async function cargarPedidos() {

            const respuesta = await fetch(
                '../veterinaria_rest/index.php', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }
            );

            if (respuesta.status === 401) {
                localStorage.removeItem('token');
                localStorage.removeItem('usuario');
                window.location.href = 'login.php';
                return;
            }

            const datos = await respuesta.json();

            if (!respuesta.ok) {
                document.getElementById('resultado')
                    .textContent = JSON.stringify(datos, null, 2);
                return;
            }

            const cuerpo = document.querySelector('#tablaPedidos tbody');
            cuerpo.innerHTML = '';

            datos.forEach(pedido => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${pedido.id}</td>
                    <td>${pedido.producto_id}</td>
                    <td>${pedido.cantidad}</td>
                    <td>${pedido.fecha}</td>
                `;
                cuerpo.appendChild(fila);
            });
        }

        cargarPedidos();
    </script>

</body>

</html>
