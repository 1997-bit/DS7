<?php

require_once __DIR__ . "/../config/conexion.php";

class Servicio
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    public function obtenerTodos()
    {
        $sql = "SELECT * FROM servicio";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}
