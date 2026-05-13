<?php

require_once __DIR__ . "/../config/conexion.php";

class OrdenServicio
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    public function crear(
        $idOrden,
        $idServicio,
        $cantidad,
        $subtotal
    ) {

        $sql = "INSERT INTO orden_servicio
        (
            id_orden,
            id_servicio,
            cantidad,
            subtotal
        )
        VALUES
        (
            :id_orden,
            :id_servicio,
            :cantidad,
            :subtotal
        )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id_orden' => $idOrden,
            ':id_servicio' => $idServicio,
            ':cantidad' => $cantidad,
            ':subtotal' => $subtotal
        ]);
    }
}
