<?php

require_once __DIR__ . '/../config/database.php';

class UsuarioModel
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->getConnection();
    }

    public function obtenerPorUsername($username)
    {
        $sql = "SELECT id, username, password FROM usuarios WHERE username = ? LIMIT 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$username]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }
}
