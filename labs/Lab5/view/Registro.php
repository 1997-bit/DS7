<?php

?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Registro</title>
		<link rel="stylesheet" href="../assets/css/base.css" />
		<link rel="stylesheet" href="../assets/css/registro.css" />
		<link rel="icon" type="image/svg+xml" href="../assets/favicon.svg" />
	</head>
	<body>
		<section>
			<div id="Registro">
				<form method="POST" action="../controller/Procesar.php">
					<input type="hidden" name="accion" value="registro" />
					<h3>REGISTRO</h3>

					<label
						>Usuario:
						<input
							type="text"
							name="usuario"
							minlength="3"
							maxlength="11"
							required
						/> </label
					><br /><br />

					<label
						>Contraseña:
						<input
							type="password"
							name="contrasena"
							minlength="5"
							required
						/> </label
					><br /><br />

					<button type="submit">Registrar</button>
					<p><a href="Login.php">Ya tengo cuenta</a></p>
				</form>
			</div>
		</section>
	</body>
</html>
