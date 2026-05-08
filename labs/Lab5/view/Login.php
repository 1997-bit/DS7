<?php session_start();

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

					<button type="submit">Ingresar</button>
					<p><a href="Registro.php">Crear Cuenta</a></p>
				</form>
			</div>
		</section>
	</body>
</html>
