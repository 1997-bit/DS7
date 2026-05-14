<form>
	<label>Tipo de documento</label>
	<select name="tipo_doc" id="tipo_doc" required onchange="toggleDoc()">
		<option value="cedula">Cédula</option>
		<option value="pasaporte">Pasaporte</option>
	</select>

	<label>Número de documento</label>
	<input
		type="text"
		name="documento"
		id="documento"
		autocomplete="off"
		required
		placeholder="Cédula o pasaporte"
	/>
	<small id="doc_hint"></small>

	<label>Nombre</label>
	<input
		type="text"
		name="nombre"
		autocomplete="given-name"
		placeholder="Miguel"
		required
	/>

	<label>Apellido</label>
	<input
		type="text"
		name="apellido"
		autocomplete="family-name"
		placeholder="Caballero"
		required
	/>

	<label>Estado civil</label>
	<select name="estado_civil">
		<option value="">Seleccione</option>
		<option>Soltero(a)</option>
		<option>Casado(a)</option>
		<option>Unido(a)</option>
		<option>Divorciado(a)</option>
		<option>Viudo(a)</option>
	</select>

	<label>Género </label>
	<select name="genero" required>
		<option value="">Seleccione</option>
		<option>Masculino</option>
		<option>Femenino</option>
	</select>

	<label>Tipo de sangre</label>
	<select name="sangre">
		<option value="">Seleccione</option>
		<option>A+</option>
		<option>A-</option>
		<option>B+</option>
		<option>B-</option>
		<option>AB+</option>
		<option>AB-</option>
		<option>O+</option>
		<option>O-</option>
	</select>

	<label>Fecha de nacimiento </label>
	<input type="date" name="fecha_nacimiento" autocomplete="bday" required />

	<label>Nacionalidad</label>
	<select name="nacionalidad" required>
		<?php include __DIR__ . '/partials/form/paises.php'; ?>
	</select>

	<label>Teléfono</label>
	<input type="tel" name="telefono" pattern="[0-9+\-\s]{7,15}" required />

	<label>Residencia</label>
	<input type="text" name="residencia" spellcheck="true" required />

	<label>Correo electrónico</label>
	<input
		type="email"
		name="correo"
		autocomplete="email"
		pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$"
		required
	/>

	<button type="submit">Enviar</button>
</form>

<script>
	function toggleDoc() {
		const type = document.getElementById("tipo_doc").value;
		const input = document.getElementById("documento");
		const hint = document.getElementById("doc_hint");

		if (type === "cedula") {
			input.pattern =
				"^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\\d{1,4})-(\\d{1,6})$";
			input.placeholder = "8-123-456 | PE-123-123";
			hint.textContent = "Formato cédula Panamá";
		} else {
			input.pattern = "^[A-Z0-9]{5,20}$";
			input.placeholder = "Pasaporte";
			hint.textContent = "Alfanumérico simple (ajustable país)";
		}

		input.value = "";
	}

	toggleDoc();
</script>
