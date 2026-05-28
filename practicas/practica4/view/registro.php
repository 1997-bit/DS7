<?php
$error = $_GET['error'] ?? '';
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/registro.css" />
</head>
<body>
    <section>
        <div id="Registro">
            <form method="POST" action="../controller/RegistroController.php">
                <h3>REGISTRO</h3>

                <?php if ($error === 'usuario_existe'): ?>
                    <p class="error">El usuario ya existe.</p>
                <?php elseif ($error === 'campos_vacios'): ?>
                    <p class="error">Completa todos los campos.</p>
                <?php endif; ?>

                <label>Usuario:
                    <input type="text" name="usuario" minlength="3" maxlength="30" required />
                </label><br /><br />

                <label>Contraseña:
                    <input type="password" name="contrasena" minlength="5" required />
                </label><br /><br />

                <!-- Campo oculto para identificar la acción -->
                <input type="hidden" name="accion" value="registro" />

                <button class="registro" type="submit">Registrar</button>
                <button class="tienecuenta" type="button"
                    onclick="window.location.href='../view/login.php'">
                    Ya tengo cuenta
                </button>
            </form>
        </div>
    </section>
</body>
</html>