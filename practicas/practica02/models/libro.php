<?php
require_once "../config/conexion.php";

class Libro extends Conexion {

    public function insertar($nombre, $autor, $categoria, $anio) {
        $conexion = Conexion::Conectar();
        $consulta = $conexion->prepare(
            "INSERT INTO libros (nombre, autor, categoria, anio)
             VALUES (:nombre, :autor, :categoria, :anio)"
        );
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':autor', $autor);
        $consulta->bindParam(':categoria', $categoria);
        $consulta->bindParam(':anio', $anio);
        $consulta->execute();
    }

    public function obtenerTodo() {
        $conexion = Conexion::Conectar();
        $consulta = $conexion->prepare("SELECT * FROM libros");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $autor, $categoria, $anio) {
        $conexion = Conexion::Conectar();
        $consulta = $conexion->prepare(
            "UPDATE libros
             SET nombre = :nombre, autor = :autor,
                 categoria = :categoria, anio = :anio
             WHERE id = :id"
        );
        $consulta->bindParam(':id', $id);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':autor', $autor);
        $consulta->bindParam(':categoria', $categoria);
        $consulta->bindParam(':anio', $anio);
        $consulta->execute();
    }


    public function eliminar($id) {
        $conexion = Conexion::Conectar();
        $consulta = $conexion->prepare("DELETE FROM libros WHERE id = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();
    }


}
?>