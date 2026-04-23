<h2>Libros</h2>
<link rel="stylesheet" href="../assets/style.css">
<a href="../controller/librocontroller.php?accion=crear">Nuevo</a>

<table border="1">
	<tr>
		<th>Nombre</th>
		<th>Autor</th>
		<th>Categoria</th>
		<th>Año</th>
		<th>Acciones</th>
	</tr>
	<?php foreach($datos as $d){ ?>
	<tr>
		<td><?= $d["nombre"] ?></td>
		<td><?= $d["autor"] ?></td>
		<td><?= $d["categoria"] ?></td>
		<td><?= $d["anio"] ?></td>
		<td>
			<a
				href="../controller/librocontroller.php?accion=editar&id=<?= $d['id'] ?>"
				>Editar</a
			>
			<a
				href="../controller/librocontroller.php?accion=eliminar&id=<?= $d['id'] ?>"
				>Eliminar</a
			>
		</td>
	</tr>
	<?php } ?>
</table>
