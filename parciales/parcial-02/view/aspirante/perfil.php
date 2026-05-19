<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Editar Perfil</title>
		<link rel="stylesheet" href="/assets/css/formulario.css" />
	</head>
	<body>
		<form method="POST" action="/perfil" autocomplete="on">
		<input type="hidden" name="csrf_token" value="<?= Security::generarCsrfToken() ?>">


		</form>

	</body>
</html>
