<h2>Nuevo Libro</h2>
<link rel="stylesheet" href="../assets/style.css">
<a href="../controller/librocontroller.php?accion=listar">← Volver</a>

<form method="POST" action="../controller/librocontroller.php?accion=crear">
	<label>Nombre: <input type="text" name="nombre" required /></label><br />
	<br>
	<label>Autor: <input type="text" name="autor" required /></label><br />
	<br>
	<label>Categoría: <input type="text" name="categoria" required /></label
	><br />
	<br>
	<label
		>Año:
		<input
			type="number"
			name="anio"
			min="1000"
			max="2099"
			required /></label
	><br />
	<br>
	<button type="submit" id="Guardarbtn">Guardar</button>
</form>