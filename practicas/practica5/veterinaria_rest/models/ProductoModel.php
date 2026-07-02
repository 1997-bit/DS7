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

    public function guardarPedido($productoId, $cantidad, $usuarioId)
    {
        $sql = "
            INSERT INTO pedidos
            (producto_id, cantidad, usuario_id)
            VALUES (?, ?, ?)
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            $productoId,
            $cantidad,
            $usuarioId
        ]);
    }

    public function obtenerPedidos($usuarioId)
    {
        $sql = "
            SELECT id, producto_id, cantidad, fecha
            FROM pedidos
            WHERE usuario_id = ?
            ORDER BY fecha DESC
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$usuarioId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
