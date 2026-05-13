<?php

require_once "../config/session.php";

if (!isset($_SESSION["usuario"])) {
	header("Location: Login.php");
	exit();
}

$cliente = $_SESSION["cliente"] ?? [];
$cantidades = $_SESSION["cantidad"] ?? [];

$servicios = [
	1 => ["nombre" => "Mantenimiento", "precio" => 25],
	2 => ["nombre" => "Instalación", "precio" => 15],
	3 => ["nombre" => "Respaldo", "precio" => 10],
	4 => ["nombre" => "Limpieza", "precio" => 20],
	5 => ["nombre" => "Red", "precio" => 30]
];

$totalGeneral = 0;

?>

<!doctype html>
<html lang="es">

<head>

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Factura</title>

	<link rel="stylesheet" href="../assets/css/base.css" />
	<link rel="stylesheet" href="../assets/css/salida.css" />

</head>

<body>

	<h1>FACTURA</h1>

	<h2>Datos del Cliente</h2>

	<p><strong>Nombre:</strong> <?= $cliente["nombre"] ?></p>

	<p><strong>Apellido:</strong> <?= $cliente["apellido"] ?></p>

	<p><strong>Fecha de nacimiento:</strong> <?= $cliente["fecha_nacimiento"] ?></p>

	<p><strong>Género:</strong> <?= $cliente["genero"] ?></p>

	<p><strong>Nacionalidad:</strong> <?= $cliente["nacionalidad"] ?></p>

	<p><strong>Dirección:</strong> <?= $cliente["direccion"] ?></p>

	<hr>

	<h2>Detalle de Servicios</h2>

	<table border="1" cellpadding="10">

		<tr>
			<th>Servicio</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
		</tr>

		<?php foreach ($servicios as $id => $servicio): ?>

			<?php

			$cantidad = (int)($cantidades[$id] ?? 0);

			if ($cantidad <= 0) continue;

			$subtotal = $cantidad * $servicio["precio"];

			$totalGeneral += $subtotal;

			?>

			<tr>

				<td><?= $servicio["nombre"] ?></td>

				<td>$<?= number_format($servicio["precio"], 2) ?></td>

				<td><?= $cantidad ?></td>

				<td>$<?= number_format($subtotal, 2) ?></td>

			</tr>

		<?php endforeach; ?>

		<tr>

			<td colspan="3">
				<strong>TOTAL FINAL</strong>
			</td>

			<td>
				<strong>$<?= number_format($totalGeneral, 2) ?></strong>
			</td>

		</tr>

	</table>

	<br>

	<a href="../controller/cerrasesion.php">
		Cerrar sesión
	</a>

</body>


<style>
	body {
		background: #53b8c1;
	}
</style>

</html>