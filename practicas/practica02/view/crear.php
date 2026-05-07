<h2>Nuevo Libro</h2>
<link rel="stylesheet" href="../assets/style.css">
<a href="../controller/librocontroller.php?accion=listar">← Volver</a>

<form method="POST" action="../controller/librocontroller.php?accion=crear">
	<label>Nombre: <input type="text" name="nombre" required /></label><br />
	<label>Autor: <input type="text" name="autor" required /></label><br />
	<label>Categoría: <input type="text" name="categoria" required /></label
	><br />
	<label
		>Año:
		<input
			type="number"
			name="anio"
			min="1000"
			max="2099"
			required /></label
	><br />
	<button type="submit">Guardar</button>
</form>