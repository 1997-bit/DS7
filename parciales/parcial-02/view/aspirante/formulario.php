<style>
	.req::after{
	content:" *";
	color:#e11d48;
	font-weight:600;
}

#legend{
	grid-column:1 / -1;
	font-size:12px;
	color:#666;
	margin-top:4px;
}
	* {
		box-sizing: border-box;
		font-family: system-ui;
	}

	body {
		margin: 0;
		min-height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;
		background: #f5f5f5;
	}

	form {
		width: 760px;
		max-width: 95vw;
		padding: 24px;
		background: #fff;
		border-radius: 8px;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);

		display: grid;
		grid-template-columns: 1fr 1fr;
		gap: 18px 20px;
	}

	/* cada campo = label */
	form label {
		display: flex;
		flex-direction: column;
		font-size: 13px;
		gap: 6px;
	}

	/* inputs */
	input,
	select {
		width: 100%;
		padding: 10px;
		font-size: 14px;
	}

	/* hint doc */
	#doc_hint {
		font-size: 12px;
	}

	/* botón ancho completo */
	button {
		grid-column: 1 / -1;
		padding: 12px;
		margin-top: 8px;
		cursor: pointer;
	}

	/* móvil */
	@media (max-width: 720px) {
		form {
			grid-template-columns: 1fr;
		}
	}
</style>

<form>
	<label
		>Tipo de documento
		<select  name="tipo_doc" id="tipo_doc" required onchange="toggleDoc()">
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
		<small id="doc_hint"></small>
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
			<option>Soltero(a)</option>
			<option>Casado(a)</option>
			<option>Unido(a)</option>
			<option>Divorciado(a)</option>
			<option>Viudo(a)</option>
		</select>
	</label>
	<label
		>Género
		<select name="genero" required>
			<option value="">Seleccione</option>
			<option>Masculino</option>
			<option>Femenino</option>
		</select>
	</label>
	<label
		>Tipo de sangre
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
			required
		/>
	</label>
	<label
		>Residencia
		<input type="text" name="residencia" spellcheck="true" required />
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

<script>
	function toggleDoc() {
		const type = document.getElementById("tipo_doc").value;
		const input = document.getElementById("documento");
		const hint = document.getElementById("doc_hint");

		if (type === "cedula") {
			input.pattern =
				"^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\\d{1,4})-(\\d{1,6})$";
			input.placeholder = "8-123-456 | PE-123-123";
		} else {
			input.pattern = "^[A-Z0-9]{5,20}$";
			input.placeholder = "Pasaporte";
		}

		input.value = "";
	}

	toggleDoc();
</script>
