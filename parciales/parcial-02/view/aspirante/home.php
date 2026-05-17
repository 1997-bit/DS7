<?php

?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<title>Home</title>
		<link rel="stylesheet" href="/assets/css/base.css" />
	</head>
	<body>
		<?php require BASE_PATH . 'view/partials/navbar.php'; ?>

		<hr />

		<h2>Mi solicitud</h2>

		<?php if (!$perfil): ?>
		<div>
			<p>Sin información registrada.</p>
			<a href="/formulario">Completar formulario</a>
		</div>

		<?php else: ?> <?php $estado = $perfil['estado'] ?? 'no_revisado';
		$label = match($estado) { 'considerado' => 'CONSIDERADO',
		'no_considerado' => 'NO CONSIDERADO', default => 'NO REVISADO' }; ?>

		<div style="padding: 10px; border: 1px solid #ccc; margin-bottom: 15px">
			<b>Estado:</b> <?= $label ?>
		</div>

		<h3>Datos personales</h3>

		<ul>
			<li><b>Cédula:</b> <?= htmlspecialchars($perfil['cedula']) ?></li>
			<li><b>Nombre:</b> <?= htmlspecialchars($perfil['nombre']) ?></li>
			<li>
				<b>Apellido:</b> <?= htmlspecialchars($perfil['apellido']) ?>
			</li>
			<li><b>Género:</b> <?= htmlspecialchars($perfil['genero']) ?></li>
			<li>
				<b>Nacionalidad:</b> <?=
				htmlspecialchars($perfil['nacionalidad']) ?>
			</li>
			<li>
				<b>Teléfono:</b> <?= htmlspecialchars($perfil['telefono']) ?>
			</li>
			<li><b>Correo:</b> <?= htmlspecialchars($perfil['correo']) ?></li>
		</ul>

		<a href="/perfil">Actualizar información</a>

		<?php endif; ?>
	</body>
</html>
