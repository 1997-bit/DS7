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
					<input
						type="hidden"
						name="csrf_token"
						value="<?= Security::generarCsrfToken() ?>"
					/>

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
							minlength="15"
							pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{15,}$"
							title="Min 15 chars, mayúscula, minúscula, número y símbolo"
							required
						/> </label
					><br /><br />

					<?php if (isset($_GET['error']) && $_GET['error'] ===
					'contrasena'): ?>
					<p style="color: red">
						La contraseña debe tener mínimo 15 caracteres,
						mayúscula, minúscula, número y símbolo.
					</p>
					<?php endif; ?> <?php if (isset($_GET['error']) &&
					$_GET['error'] === 'duplicado'): ?>
					<p style="color: red">
						Ese nombre de usuario ya está en uso.
					</p>
					<?php endif; ?>
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
