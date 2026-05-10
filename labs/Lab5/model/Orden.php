<?php

require_once __DIR__ . "/../config/conexion.php";

class Orden
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    public function crear($idCliente, $total)
    {

        $sql = "INSERT INTO orden
        (
            id_cliente,
            total,
            fecha
        )
        VALUES
        (
            :id_cliente,
            :total,
            NOW()
        )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id_cliente' => $idCliente,
            ':total' => $total
        ]);

        return $this->pdo->lastInsertId();
    }
}
