<?php
require_once __DIR__ . "/../Config/conexionSecreta.php";

class Libro {
    private $db;

    public function __construct() {
        $this->db = Conexion::Conectar();
    }

    public function listar() {
        $stmt = $this->db->prepare("SELECT * FROM libro");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna array asociativo [9]
    }

    public function insertar($nombre, $autor, $categoria, $anio) {
        $sql = "INSERT INTO libro (Nombre, Autor, Categoria, Año) VALUES (:n, :a, :c, :y)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':n', $nombre);
        $stmt->bindParam(':a', $autor);
        $stmt->bindParam(':c', $categoria);
        $stmt->bindParam(':y', $anio);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM libro WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $autor, $categoria, $anio) {
        $sql = "UPDATE libro SET Nombre=:n, Autor=:a, Categoria=:c, Año=:y WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':n', $nombre);
        $stmt->bindParam(':a', $autor);
        $stmt->bindParam(':c', $categoria);
        $stmt->bindParam(':y', $anio);
        return $stmt->execute(); // Siempre usa WHERE en UPDATE [10] para evitar actualizar todo por error
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM libro WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // Siempre usa WHERE en DELETE [11] para evitar eliminar todo por error
    }
}
?>