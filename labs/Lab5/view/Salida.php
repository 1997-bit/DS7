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
		<title>Salida</title>
	</head>
	<body>
		<h1>Bienvenido</h1>

		<?php echo "Usuario: " . $_SESSION["usuario"]; ?>

		<br /><br />

		<a href="Cerrar.php">Cerrar sesión</a>
	</body>
</html>
