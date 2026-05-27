<?php
require_once __DIR__ . "/../models/libro.php";

$libro = new Libro();
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
} else {
    $accion = 'listar';
}

switch ($accion) {
    case 'listar':
        $datos = $libro->obtenerTodo();
        require_once __DIR__ . "/../view/listar.php";
        break;

    case 'crear':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $libro->insertar(
                $_POST['nombre'],
                $_POST['autor'],
                $_POST['categoria'],
                $_POST['anio']
            );
            header("Location: librocontroller.php?accion=listar");
            exit;
        }
        require_once __DIR__ . "/../view/crear.php";
        break;

    case 'editar':
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $libro->actualizar(
                $id,
                $_POST['nombre'],
                $_POST['autor'],
                $_POST['categoria'],
                $_POST['anio']
            );
            header("Location: librocontroller.php?accion=listar");
            exit;
        }
        $datos = $libro->obtenerPorId($id);
        require_once __DIR__ . "/../view/editar.php";
        break;

    case 'eliminar':
        $libro->eliminar($_GET['id']);  
        header("Location: librocontroller.php?accion=listar");
        exit;
}
?>