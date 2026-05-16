<?php
require_once __DIR__ . "/../config/conexion.php";

class Usuario
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    /** Registra usuario. Retorna id o lanza excepción. */
    public function registrar(string $usuario, string $contrasena): int
    {
        $hash = password_hash($contrasena, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO usuario (id_usuario, contrasena) VALUES (:u, :c)"
        );
        $stmt->execute([':u' => $usuario, ':c' => $hash]);
        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Verifica credenciales.
     * Retorna ['id' => int, 'usuario' => string] o null.
     */
    public function login(string $usuario, string $contrasena): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, id_usuario, contrasena FROM usuario WHERE id_usuario = :u LIMIT 1"
        );
        $stmt->execute([':u' => $usuario]);
        $row = $stmt->fetch();

        if (!$row || !password_verify($contrasena, $row['contrasena'])) {
            return null;
        }

        return [
            'id' => (int) $row['id'],
            'usuario' => $row['id_usuario'],
        ];
    }
}