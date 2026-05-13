<h2>Editar Libro</h2>
<link rel="stylesheet" href="../assets/style.css">
<a href="../controller/librocontroller.php?accion=listar">← Volver</a>

<form
	method="POST"
	action="../controller/librocontroller.php?accion=editar&id=<?= $datos['id'] ?>"
>
	<label
		>Nombre:
		<input
			type="text"
			name="nombre"
			value="<?= htmlspecialchars($datos['nombre']) ?>"
			required /></label
	><br />
	<br>
	<label
		>Autor:
		<input
			type="text"
			name="autor"
			value="<?= htmlspecialchars($datos['autor']) ?>"
			required /></label
	><br />
	<br>
	<label
		>Categoría:
		<input
			type="text"
			name="categoria"
			value="<?= htmlspecialchars($datos['categoria']) ?>"
			required /></label
	><br />
	<br>
	<label
		>Año:
		<input
			type="number"
			name="anio"
			value="<?= $datos['anio'] ?>"
			min= "1000"
			max="2100"
			required /></label
	><br />
	<br>
	<button type="submit" id="Actualizarbtn">Actualizar</button>
</form>
