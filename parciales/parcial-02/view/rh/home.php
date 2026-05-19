<?php

?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Panel RH</title>
		<link rel="stylesheet" href="/assets/css/base.css" />
		<link rel="stylesheet" href="/assets/css/rh.css" />
	</head>
	<body>
		<!-- Navbar -->
		<nav>
			<span>Panel RH</span>
			<a href="/rh/logout">Cerrar Sesión</a>
		</nav>

		<!-- Tabla de aspirantes -->
		<div class="tabla-container">
			<h2>Aspirantes</h2>
			<table>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Correo</th>
						<th>Estado</th>
						<th>Detalle</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($aspirantes as $aspirante): ?>
					<tr>
						<td><?= htmlspecialchars($aspirante['nombre']) ?></td>
						<td><?= htmlspecialchars($aspirante['apellido']) ?></td>
						<td><?= htmlspecialchars($aspirante['correo']) ?></td>
						<td><?= htmlspecialchars($aspirante['estado']) ?></td>
						<td>
							<button
								onclick="verDetalle(<?= htmlspecialchars(json_encode($aspirante)) ?>)"
							>
								Ver Detalle
							</button>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>

		<!-- Modal (fuera de la tabla) -->
		<div
			id="modal"
			style="
				display: none;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background: rgba(0, 0, 0, 0.5);
				justify-content: center;
				align-items: center;
			"
		>
			<div
				style="
					background: white;
					padding: 30px;
					width: 500px;
					border-radius: 8px;
				"
			>
				<h3 id="modal-nombre"></h3>
				<p><strong>Cédula:</strong> <span id="modal-cedula"></span></p>
				<p><strong>Correo:</strong> <span id="modal-correo"></span></p>
				<p>
					<strong>Teléfono:</strong> <span id="modal-telefono"></span>
				</p>
				<p>
					<strong>Residencia:</strong>
					<span id="modal-residencia"></span>
				</p>
				<p>
					<strong>Fecha Nacimiento:</strong>
					<span id="modal-fecha"></span>
				</p>
				<p>
					<strong>Estado Civil:</strong>
					<span id="modal-estado-civil"></span>
				</p>
				<p><strong>Género:</strong> <span id="modal-genero"></span></p>
				<p>
					<strong>Nacionalidad:</strong>
					<span id="modal-nacionalidad"></span>
				</p>

				<br />
				<label
					><strong>Estado:</strong>
					<select id="modal-estado">
						<option value="no_revisado">No Revisado</option>
						<option value="considerado">Considerado</option>
						<option value="no_considerado">No Considerado</option>
					</select>
				</label>

				<br /><br />
				<button onclick="guardarEstado()">Guardar</button>
				<button onclick="cerrarModal()">Cerrar</button>
			</div>
		</div>

		<script>
			let aspiranteActual = null;

			function verDetalle(aspirante) {
				aspiranteActual = aspirante;

				document.getElementById("modal-nombre").textContent =
					aspirante.nombre + " " + aspirante.apellido;
				document.getElementById("modal-cedula").textContent =
					aspirante.cedula;
				document.getElementById("modal-correo").textContent =
					aspirante.correo;
				document.getElementById("modal-telefono").textContent =
					aspirante.telefono;
				document.getElementById("modal-residencia").textContent =
					aspirante.residencia;
				document.getElementById("modal-fecha").textContent =
					aspirante.fecha_nacimiento;
				document.getElementById("modal-estado-civil").textContent =
					aspirante.estado_civil;
				document.getElementById("modal-genero").textContent =
					aspirante.genero;
				document.getElementById("modal-nacionalidad").textContent =
					aspirante.nacionalidad;
				document.getElementById("modal-estado").value =
					aspirante.estado;

				document.getElementById("modal").style.display = "flex";
			}

			function cerrarModal() {
				document.getElementById("modal").style.display = "none";
				aspiranteActual = null;
			}

			function guardarEstado() {
				const csrfToken = "<?= Security::generarCsrfToken() ?>";

				fetch("/rh/actualizar_estado", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"X-CSRF-Token": csrfToken,
					},
					body: JSON.stringify({
						id: aspiranteActual.id,
						estado: document.getElementById("modal-estado").value,
					}),
				})
					.then((res) => res.json())
					.then((data) => {
						if (data.ok) {
							cerrarModal();
							location.reload();
						}
					});
			}
		</script>
	</body>
</html>
