<?php

require_once "../config/session.php";
require_once "../model/Servicio.php";

if (!isset($_SESSION["usuario"])) {
	header("Location: Login.php");
	exit();
}

$servicioModel = new Servicio();

$servicios = $servicioModel->obtenerTodos();

?>

<!doctype html>
<html lang="en">

<head>

	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Expires" content="0" />


	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Formulario</title>

	<link rel="stylesheet" href="../assets/css/formulario.css" />
	<link rel="icon" type="image/svg+xml" href="../assets/favicon.svg" />

</head>


<body>



	<div class="logout">
		<?php include "Logout.php"; ?>
	</div>


	<div class="mensaje-sesion">
		<?php
		if (isset($_SESSION["usuario"])) {
			echo "Bienvenido, " . ($_SESSION["usuario"]);
		} else {
			echo "No hay sesión activa";
		}
		?>
	</div>

	<section>


		<div>
			<form method="POST" action="../controller/Procesar.php" id="miFormulario">
				<input type="hidden" name="accion" value="orden">

				<label>
					Nombre:
					<input
						type="text"
						name="nombre"
						placeholder="Pablito"
						required />
				</label>

				<br /><br />

				<label>
					Apellido:
					<input
						type="text"
						name="apellido"
						placeholder="Clavito"
						required />
				</label>

				<label>
					Fecha de nacimiento:
					<input
						type="date"
						name="fecha_nacimiento"
						min="1930-01-01"
						required />
				</label>

				<br /><br />

				<label>
					Género:
					<select name="genero" required>

						<option value="">Seleccione</option>

						<option value="M">
							Masculino
						</option>

						<option value="F">
							Femenino
						</option>

						<option value="O">
							Otro
						</option>

					</select>
				</label>

				<br /><br />

				<label>
					Nacionalidad:
					<input
						type="text"
						name="nacionalidad"
						placeholder="Panameño"
						required />
				</label>

				<br /><br />

				<label>
					Dirección:
					<input
						type="text"
						name="direccion"
						placeholder="Chucunaque"
						required />
				</label>

				<label>
					Email:

					<input
						type="email"
						name="email"
						placeholder="correo@gmail.com"
						required />
				</label>

				<br /><br />

				<!-- Tabla de los servicios -->
				<div class="servicios">
					<h3>Servicios</h3>

					<table class="tabla-servicios">
						<thead>
							<tr>
								<th>Servicio</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($servicios as $servicio): ?>

								<tr>

									<td>
										<?= $servicio["descripcion"] ?>
									</td>

									<td>
										<?= number_format($servicio["precio"], 2) ?>
									</td>

									<td>

										<input
											type="number"
											name="cantidad[<?= $servicio["id"] ?>]"
											min="0"
											value="0"
											data-precio="<?= $servicio["precio"] ?>"
											class="qty-input" />

									</td>

									<td
										class="total-cell"
										id="total-<?= $servicio["id"] ?>">
										0.00
									</td>

								</tr>

							<?php endforeach; ?>

						</tbody>

						<tfoot>
							<tr class="fila-total">
								<td colspan="3" style="text-align:right;">
									Total:
								</td>

								<td id="total">0.00</td>
							</tr>
						</tfoot>
					</table>
				</div>

				<br />

				<button class="enviar" type="submit">Enviar</button>

			</form>
		</div>
	</section>

</body>


<script>
	document.addEventListener("DOMContentLoaded", () => {

		const inputs = document.querySelectorAll(".qty-input");

		const totalGeneral = document.getElementById("total");

		function calcularTotales() {

			let suma = 0;

			inputs.forEach(input => {

				const precio = parseFloat(input.dataset.precio);

				const cantidad = parseInt(input.value) || 0;

				const subtotal = precio * cantidad;

				const filaId = input.name.match(/\d+/)[0];

				const celdaTotal =
					document.getElementById(`total-${filaId}`);

				celdaTotal.textContent =
					subtotal.toFixed(2);

				suma += subtotal;
			});

			totalGeneral.textContent =
				suma.toFixed(2);
		}

		inputs.forEach(input => {

			input.addEventListener(
				"input",
				calcularTotales
			);
		});

		calcularTotales();
	});
</script>


</html>