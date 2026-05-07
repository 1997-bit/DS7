<?php

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<title>Formulario</title>

		<link rel="stylesheet" href="../assets/css/formulario.css" />

		<link rel="icon" type="image/svg+xml" href="../assets/favicon.svg" />
	</head>
	<body>
		<section>
			<div>
				<form method="POST" action="../controller/Procesar.php">
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

					<h3>Servicios</h3>
					<input type="checkbox" name="servicios[]" value="1" />
					Mantenimiento $25
					<br />
					<input type="checkbox" name="servicios[]" value="2" />
					Instalación $15
					<br />
					<input type="checkbox" name="servicios[]" value="3" />
					Respaldo $10
					<br />
					<input type="checkbox" name="servicios[]" value="4" />
					Limpieza $20
					<br />
					<input type="checkbox" name="servicios[]" value="5" />
					Red $30
					<br />

					<button>Enviar</button>
				</form>
			</div>
		</section>
	</body>
</html>
