<?php
session_start();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Registro</title>
	</head>
	<body>
		<form method="POST" action="../controller/Procesar.php">
			<label>
				Usuario:
				<input type="text" name="usuario" required />
			</label>

			<br /><br />

			<label>
				Nombre:
				<input type="text" name="nombre" required />
			</label>

			<br /><br />

			<label>
				Apellido:
				<input type="text" name="apellido" required />
			</label>

			<br /><br />

			<label>
				Contraseña:
				<input type="password" name="contraseña" required />
			</label>

			<br /><br />

			<button type="submit">Guardar</button>
		</form>
	</body>
</html>
