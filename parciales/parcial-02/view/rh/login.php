<?php 


?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>Login</title>

		<link rel="stylesheet" href="../assets/css/base.css" />
		<link rel="stylesheet" href="../assets/css/login.css" />

		<link rel="icon" type="image/svg+xml" href="../assets/favicon.svg" />
	</head>
	<body>
		<section>
			<div id="Login">
				<form method="POST" action="../controller/Procesar.php">
					<input type="hidden" name="accion" value="login" />
					<h3>LOGIN</h3>

					<?php if (isset($_GET["error"]) && $_GET["error"] === "sesion"): ?>
    				<p style="color: red;">Tu sesión ha expirado, inicia sesión nuevamente.</p>
					<?php endif; ?>

					<?php if (isset($_GET["error"]) && $_GET["error"] === "credenciales"): ?>
						<p style="color: white;">Usuario o contraseña incorrectos.</p>
					<?php endif; ?>

					<label>
						Usuario:
						<input type="text" name="usuario" required />
					</label>

					<br /><br />

					<label>
						Contraseña:
						<input type="password" name="contrasena" required />
					</label>

					<br /><br />

					<button class="ingresar" type="submit">Ingresar</button>
					<button class="registrar" onclick="window.location.href='Registro.php'">Crear Cuenta</button>
				</form>
			</div>
		</section>
	</body>
</html>
