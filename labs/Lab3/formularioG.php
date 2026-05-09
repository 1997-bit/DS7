<?php 

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>FormularioGET</title>

		<style>
			body {
				background-color: rgba(93, 81, 226, 0.73);
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
				font-family: "Trebuchet MS", Arial, sans-serif;
			}

			section {
				background: rgba(15, 234, 15, 0.73);
				padding: 30px;
				border-radius: 15px;
				box-shadow: 0 10px 25px rgba(37, 7, 136, 0.73);
				width: 220px;
			}

			form {
				display: flex;
				flex-direction: column;
				gap: 12px;
			}

			input {
				padding: 10px;
				border: 3px solid #754404;
				border-radius: 8px;
			}

			#Enviar,
			#IrIMC {
				cursor: pointer;
			}

			#Enviar:hover,
			#IrIMC:hover {
				color: red;
				background: #e6df08;
			}
		</style>
	</head>

	<body>
		<section>
			<form action="salidaG.php" method="GET">
				<input
					type="text"
					name="nombre"
					placeholder="Ingrese su nombre"
					required
				/>
				<input
					type="number"
					name="peso"
					step="any"
					placeholder="Peso (kg)"
					required
				/>
				<input
					type="number"
					name="altura"
					step="any"
					placeholder="Altura (m)"
					required
				/>

				<input type="submit" value="Calcular IMC" id="Enviar" />

				<input
					type="button"
					value="Regresar"
					id="IrIMC"
					onclick="location.href = 'formularioP.php'"
				/>
			</form>
		</section>
	</body>
</html>
