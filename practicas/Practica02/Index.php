<?php

#Grupo 2
//Integrantes:
// - Jonathan Gomez
// - Juan Garcia
// - Gloria Moreno
// - Miguel Caballero

#Enunciado
/* Desarrollar un sistema en PHP que permita administrar libros usando una base de datos.
- El sistema debe permitir insertar un nuevo libro. Con los campos: nombre de libro, autor, categoria y año.
- El sistema debe poder mostrar los libros almacenados en la base de datos.
- Se debe poder editar la informcacion de uno de los libros existentes.
- También se debe poder eliminar uno de los libros que ya estén registrados.

#Estructura
Proyecto
|-- Index.php
|-- Config
    |-- Conexion.php
|-- Models
    |-- Libro.php
|-- Controlador
    |-- LibroController.php
|-- Vistas
    |-- CrearLibro.php
    |-- EditarLibro.php
    |-- ListarLibros.php
|-- Assets
    |-- style.css
    |-- validaciones.js
*/

// Punto de entrada principal
require_once "Config/conexionSecreta.php";
require_once "Models/Libro.php";
require_once "Controlador/libroController.php";
require_once "Vistas/Listar.php";

?>