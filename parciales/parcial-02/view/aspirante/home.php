<?php

?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<title>Home</title>
		<link rel="stylesheet" href="/assets/css/base.css" />
		<link rel="stylesheet" href="/assets/css/home.css" />
	</head>
	<body>
		<?php require BASE_PATH . 'view/partials/navbar.php'; ?>

		<div class="container">
			<h2>Mi solicitud</h2>

			<?php if (!$perfil): ?>
			<div class="sin-informacion">
				<p>Sin información registrada.</p>
				<a href="/formulario">Completar formulario</a>
			</div>

			<?php else: ?>
				<?php $estado = $perfil['estado'] ?? 'no_revisado';
				$label = match($estado) {
					'considerado' => 'CONSIDERADO',
					'no_considerado' => 'NO CONSIDERADO',
					default => 'NO REVISADO'
				};
				$clase_estado = match($estado) {
					'considerado' => 'estado-considerado',
					'no_considerado' => 'estado-no-considerado',
					default => 'estado-no-revisado'
				}; ?>

				<div class="estado-box">
					<b>Estado:</b> <span class="<?= $clase_estado ?>"><?= $label ?></span>
				</div>

				<h3>Datos personales</h3>

				<ul>
					<li><b>Cédula:</b> <?= htmlspecialchars($perfil['cedula']) ?></li>
					<li><b>Nombre:</b> <?= htmlspecialchars($perfil['nombre']) ?></li>
					<li><b>Apellido:</b> <?= htmlspecialchars($perfil['apellido']) ?></li>
					<li><b>Género:</b> <?= htmlspecialchars($perfil['genero']) ?></li>
					<li><b>Nacionalidad:</b> <?= htmlspecialchars($perfil['nacionalidad']) ?></li>
					<li><b>Teléfono:</b> <?= htmlspecialchars($perfil['telefono']) ?></li>
					<li><b>Correo:</b> <?= htmlspecialchars($perfil['correo']) ?></li>
				</ul>

				<div class="botones">
					<a href="/perfil">Actualizar información</a>
				</div>
			<?php endif; ?>
		</div>
	</body>
	</body>
</html>
