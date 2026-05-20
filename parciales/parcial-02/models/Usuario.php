<?php
require_once __DIR__ . "/../config/conexion.php";

class Usuario
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    public function registrar(string $usuario, string $contrasena): int
    {
        // Primero verificar si ya existe
        $check = $this->pdo->prepare("SELECT 1 FROM usuario WHERE id_usuario = ? LIMIT 1");
        $check->execute([$usuario]);
        if ($check->fetchColumn()) {
            header("Location: /registro?error=duplicado");
            exit;
        }

        $hash = password_hash($contrasena, PASSWORD_ARGON2ID);
        $stmt = $this->pdo->prepare(
            "INSERT INTO usuario (id_usuario, contrasena) VALUES (?, ?)"
        );
        $stmt->execute([$usuario, $hash]);
        return (int)$this->pdo->lastInsertId();
    }

    public function login(string $usuario, string $contrasena): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, id_usuario, contrasena, perfil_completo 
            FROM usuario 
            WHERE id_usuario = :u 
            LIMIT 1"
        );

        $stmt->execute([':u' => $usuario]);
        $row = $stmt->fetch();

        if (!$row || !password_verify($contrasena, $row['contrasena'])) {
            return null;
        }

        return [
            'id' => (int)$row['id'],
            'usuario' => $row['id_usuario'],
            'perfil_completo' => (int)$row['perfil_completo']
        ];
    }
}