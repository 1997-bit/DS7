<?php

require_once "../config/session.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: ../view/Login.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
	<head>

	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Expires" content="0"/>


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
							required
						/>
					</label>

					<br /><br />

					<label>
						Apellido:
						<input
							type="text"
							name="apellido"
							placeholder="Clavito"
							required
						/>
					</label>

					<label>
						Fecha de nacimiento:
						<input
							type="date"
							name="fecha_nacimiento"
							min="1930-01-01"
							required
						/>
					</label>

					<br /><br />

					<label>
						Género:
						<select name="genero" required>
							<option value="M">M</option>
							<option value="F">F</option>
						</select>
					</label>

					<br /><br />

					<label>
						Nacionalidad:
						<input
							type="text"
							name="nacionalidad"
							placeholder="Panameño"
							required
						/>
					</label>

					<br /><br />

					<label>
						Dirección:
						<input
							type="text"
							name="direccion"
							placeholder="Chucunaque"
							required
						/>
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
								<!-- Fila 1 -->
								<tr>
									<td>Mantenimiento</td>
									<td>25.00</td>
									<td>
										<input
											type="number"
											name="cantidad[1]"
											min="0"
											value="0"
											data-precio="25"
											class="qty-input"
										/>
									</td>
									<td class="total-cell" id="total-1">0</td>
								</tr>

								<!-- Fila 2 -->
								<tr>
									<td>Instalación</td>
									<td>15.00</td>
									<td>
										<input
											type="number"
											name="cantidad[2]"
											min="0"
											value="0"
											data-precio="15"
											class="qty-input"
										/>
									</td>
									<td class="total-cell" id="total-2">0</td>
								</tr>

								<!-- Fila 3 -->
								<tr>
									<td>Respaldo</td>
									<td>10.00</td>
									<td>
										<input
											type="number"
											name="cantidad[3]"
											min="0"
											value="0"
											data-precio="10"
											class="qty-input"
										/>
									</td>
									<td class="total-cell" id="total-3">0</td>
								</tr>

								<!-- Fila 4 -->
								<tr>
									<td>Limpieza</td>
									<td>20.00</td>
									<td>
										<input
											type="number"
											name="cantidad[4]"
											min="0"
											value="0"
											data-precio="20"
											class="qty-input"
										/>
									</td>
									<td class="total-cell" id="total-4">0</td>
								</tr>

								<!-- Fila 5 -->
								<tr>
									<td>Red</td>
									<td>30.00</td>
									<td>
										<input
											type="number"
											name="cantidad[5]"
											min="0"
											value="0"
											data-precio="30"
											class="qty-input"
										/>
									</td>
									<td class="total-cell" id="total-5">0</td>
								</tr>
							</tbody>

							<tfoot>
								<tr class="fila-total">
									<td colspan="4" style="text-align:right;">Total:</td>
									<td id="total">0</td>
								</tr>
							</tfoot>
						</table>
					</div>

					<br />
					
					<button type="submit">Enviar</button>
					
				</form>
			</div>
		</section>

	</body>
</html>