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
		<link
			rel="icon"
			type="image/svg+xml"
			href="/assets/favicons/aspirante.svg"
		/>
	</head>
	<body>
		<section>
			<div id="Registro">
				<form method="POST" action="/registro">
					<h3>REGISTRO</h3>

					<label
						>Usuario:
						<input
							type="text"
							name="usuario"
							minlength="3"
							maxlength="30"
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

					<button class="registro" type="submit">Registrar</button>
					<button
						class="tienecuenta"
						onclick="window.location.href = '/login'"
					>
						Ya tengo cuenta
					</button>
				</form>
			</div>
		</section>
	</body>
</html>
