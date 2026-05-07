<?php

session_start();

if (!isset($_SESSION["usuario"])) {

    echo "No hay sesión iniciada";
    exit();
}

?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		
		<title>Salida</title>
		
		<link rel="stylesheet" href="../assets/css/base.css" />
		<link rel="stylesheet" href="../assets/css/salida.css" />
		
		<link rel="icon" type="image/svg+xml" href="../assets/favicon.svg">
		
	</head>
	<body>
		<h1>Bienvenido</h1>

		<?php echo "Usuario: " . $_SESSION["usuario"]; ?>

		<br /><br />

		<a href="Cerrar.php">Cerrar sesión</a>
	</body>
</html>
