<?php

session_start();

require_once("../config/Json.php");
require_once("../model/Tarea.php");

$json = new Json();

$archivo = "../assets/tareas.json";

$tareas = $json->leer($archivo);

$accion = $_POST['accion'];

if ($accion == "crear") {

    $id = time();

    $tarea = new Tarea(
        $id,
        $_SESSION['usuario'],
        $_POST['descripcion']
    );

    $tareas[] = $tarea->toArray();

    $json->guardar($archivo, $tareas);
}

if ($accion == "estado") {

    foreach ($tareas as &$tarea) {

        if ($tarea['id'] == $_POST['id']) {

            if ($tarea['estado'] == "por hacer") {
                $tarea['estado'] = "hecha";
            } else {
                $tarea['estado'] = "por hacer";
            }

            break;
        }
    }

    $json->guardar($archivo, $tareas);
}

if ($accion == "eliminar") {

    foreach ($tareas as $index => $tarea) {

        if ($tarea['id'] == $_POST['id']) {
            unset($tareas[$index]);
        }
    }

    $tareas = array_values($tareas);

    $json->guardar($archivo, $tareas);
}

header("Location: ../view/Tareas.php");
