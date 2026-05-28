<?php
require_once("../model/Tarea.php");
require_once("../config/Json.php");
require_once("../config/session.php");

$json = new Json();
$accion = $_POST['accion'] ?? null;

if ($accion == "crear") {
    $tareas = $json->leerTareas();
    $id = count($tareas) > 0 ? max(array_column($tareas, 'id')) + 1 : 1;
    
    $tarea = new Tarea($id, $_SESSION['usuario_id'], $_POST['titulo'], $_POST['descripcion']);
    
    $tareas[] = [
        "id" => $tarea->id,
        "usuarioId" => $tarea->usuarioId,
        "titulo" => $tarea->titulo,
        "descripcion" => $tarea->descripcion,
        "estado" => $tarea->estado,
        "fechaCreacion" => $tarea->fechaCreacion
    ];
    
    $json->guardarTareas($tareas);
    header("Location: ../view/Tareas.php");
    exit;
}

if ($accion == "editar") {
    $tareas = $json->leerTareas();
    
    foreach ($tareas as &$t) {
        if ($t['id'] == $_POST['id'] && $t['usuarioId'] == $_SESSION['usuario_id']) {
            $t['titulo'] = $_POST['titulo'];
            $t['descripcion'] = $_POST['descripcion'];
            break;
        }
    }
    
    $json->guardarTareas($tareas);
    header("Location: ../view/Tareas.php");
    exit;
}

if ($accion == "cambiar_estado") {
    $tareas = $json->leerTareas();
    
    foreach ($tareas as &$t) {
        if ($t['id'] == $_POST['id'] && $t['usuarioId'] == $_SESSION['usuario_id']) {
            $t['estado'] = $_POST['estado'];
            break;
        }
    }
    
    $json->guardarTareas($tareas);
    header("Location: ../view/Tareas.php");
    exit;
}

if ($accion == "eliminar") {
    $tareas = $json->leerTareas();
    $tareas = array_filter($tareas, function($t) {
        return !($t['id'] == $_POST['id'] && $t['usuarioId'] == $_SESSION['usuario_id']);
    });
    
    $json->guardarTareas(array_values($tareas));
    header("Location: ../view/Tareas.php");
    exit;
}
