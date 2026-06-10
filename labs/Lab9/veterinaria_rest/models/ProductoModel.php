<?php

require_once __DIR__ . '/../config/database.php';

class ProductoModel
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->getConnection();
    }

    public function guardarPedido($productoId, $cantidad)
    {
        $sql = "
            INSERT INTO pedidos
            (producto_id, cantidad)
            VALUES (?, ?)
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $productoId,
            $cantidad
        ]);
    }
}
