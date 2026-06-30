<!DOCTYPE html>
<html>

<head>
    <title>Prueba REST</title>
</head>

<body>

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

    <pre id="resultado"></pre>

    <script>
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
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            producto_id,
                            cantidad
                        })
                    }
                );

                const datos = await respuesta.json();

                document.getElementById('resultado')
                    .textContent =
                    JSON.stringify(datos, null, 2);
            });
    </script>

</body>

</html>