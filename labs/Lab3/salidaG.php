<?php
require_once "Claseprincipal.php";

$nombre = $_GET["nombre"];
$peso   = $_GET["peso"];
$altura = $_GET["altura"];

$obj = new Claseprincipal();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>ResultadoGET</title>

		<style>
			body {
				background: linear-gradient(
					135deg,
					#20c997,
					#0d6efd,
					#7b49f9,
					#a1d9dc
				);
				font-family: Arial, sans-serif;
				display: flex;
				justify-content: center;
				align-items: center;
				height: 100vh;
			}

			.caja {
				background: skyblue;
				padding: 25px;
				border-radius: 15px;
				width: 350px;
				box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
			}

			h2 {
				text-align: center;
				color: green;
			}

			.dato {
				margin: 6px 0;
			}

			.servidor {
				margin-top: 15px;
				font-size: 12px;
				color: #333;
				word-break: break-all;
				border-top: 1px solid rgba(0, 0, 0, 0.2);
				padding-top: 10px;
			}

			#regresar {
				cursor: pointer;
				display: block;
				margin: 15px auto 0 auto;
				padding: 10px;
				border: 3px solid #05ed43;
				border-radius: 8px;
			}

			#regresar:hover {
				color: white;
				background: #0e0e0e;
			}
		</style>
	</head>

	<body>
		<div class="caja">
			<h2>Resultado IMC (GET)</h2>

			<div class="dato"><strong>Nombre:</strong> <?= $nombre ?></div>
			<div class="dato"><strong>Peso:</strong> <?= $peso ?> kg</div>
			<div class="dato"><strong>Altura:</strong> <?= $altura ?> m</div>

			<?php $obj->calcularIMC($nombre,$peso,$altura); ?>

			<div class="servidor"><?php $obj->mostrarServidor(); ?></div>

			<form action="formularioG.php">
				<input type="submit" value="Regresar" id="regresar" />
			</form>
		</div>
	</body>
</html>
