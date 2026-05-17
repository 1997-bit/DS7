<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="stylesheet" href="../assets/css/formulario.css" />

		<title>Document</title>
	</head>
	<body>
		<form method="POST" action="/formulario">
			<label
				>Tipo de documento
				<select
					name="tipo_doc"
					id="tipo_doc"
					required
				>
					<option value="cedula">Cédula</option>
					<option value="pasaporte">Pasaporte</option>
				</select>
			</label>
			<label
				>Número de documento
				<input
					type="text"
					name="documento"
					id="documento"
					autocomplete="off"
					spellcheck="false"
					required
					placeholder="Cédula o pasaporte"
				/>
			</label>
			<label
				>Nombre
				<input
					type="text"
					name="nombre"
					spellcheck="false"
					autocomplete="given-name"
					placeholder="Miguel"
					required
				/>
			</label>
			<label
				>Apellido
				<input
					type="text"
					name="apellido"
					spellcheck="false"
					autocomplete="family-name"
					placeholder="Caballero"
					required
				/>
			</label>
			<label
				>Estado civil
				<select name="estado_civil">
					<option value="">Seleccione</option>
					<option value="soltero">Soltero(a)</option>
					<option value="casado">Casado(a)</option>
					<option value="divorciado">Divorciado(a)</option>
					<option value="viudo">Viudo(a)</option>
					<option value="union_libre">Unión libre</option>
				</select>
			</label>
			<label
				>Género
				<select name="genero" required>
					<option value="">Seleccione</option>
					<option value="masculino">Masculino</option>
					<option value="femenino">Femenino</option>
				</select>
			</label>
			<label
				>Tipo de sangre
				<select name="sangre">
					<option value="">Seleccione</option>
					<option value="A+">A+</option>
					<option value="A-">A-</option>
					<option value="B+">B+</option>
					<option value="B-">B-</option>
					<option value="AB+">AB+</option>
					<option value="AB-">AB-</option>
					<option value="O+">O+</option>
					<option value="O-">O-</option>
				</select>
			</label>
			<label
				>Fecha de nacimiento
				<input
					type="date"
					name="fecha_nacimiento"
					autocomplete="bday"
					required
				/>
			</label>
			<label
				>Nacionalidad
				<select name="nacionalidad" required>
					<option value="" selected disabled>Seleccione país</option>
					<?php include __DIR__ . '/../partials/form/paises.php'; ?>
				</select>
			</label>
			<label
				>Teléfono
				<input
					type="tel"
					inputmode="tel"
					name="telefono"
					pattern="[0-9+\-\s]{7,15}"
					placeholder="1234-1234"
					required
				/>
			</label>
			<label
				>Residencia 
				<input
					type="text"
					name="residencia"
					spellcheck="true"
					placeholder="La UTP"
					required
				/>
			</label>

			<label
				>Correo electrónico
				<input
					type="email"
					name="correo"
					inputmode="email"
					autocomplete="email"
					pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"
					required
					placeholder="correo@dirección.com"
				/>
			</label>
			<div id="legend">* campos obligatorios</div>
			<button type="submit">Enviar</button>
		</form>
	</body>
</html>
