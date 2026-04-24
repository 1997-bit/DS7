<h2>Lista de libros📚</h2>
<link rel="stylesheet" href="../assets/style.css">
<div class="Nuevo">
<a href="../controller/librocontroller.php?accion=crear">Nuevo</a>
</div>
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
    			onclick="return confirm('¿Seguro que quieres eliminar este libro?')"
				>Eliminar</a
			>
		</td>
	</tr>
	<?php } ?>
</table>
