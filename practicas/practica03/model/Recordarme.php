<?php
require_once __DIR__ . "/../config/conexion.php";

class Recordarme
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    public function crear(int $userId, string $token): void
    {
        $hash = hash("sha256",$token);
        $exp  = date("Y-m-d H:i:s", time()+60*60*24*30);

        $stmt = $this->pdo->prepare(
            "INSERT INTO recuerdame(token,expiracion,id_usuario)
             VALUES(:t,:e,:u)"
        );

        $stmt->execute([
            ":t"=>$hash,
            ":e"=>$exp,
            ":u"=>$userId
        ]);
    }

    public function buscar(string $token): ?array
    {
        $hash = hash("sha256",$token);

        $stmt = $this->pdo->prepare(
            "SELECT * FROM recuerdame
             WHERE token=:t AND expiracion > NOW()
             LIMIT 1"
        );

        $stmt->execute([":t"=>$hash]);
        return $stmt->fetch() ?: null;
    }

    public function borrar(string $token): void
    {
        $hash = hash("sha256",$token);

        $stmt = $this->pdo->prepare(
            "DELETE FROM recuerdame WHERE token=:t"
        );
        $stmt->execute([":t"=>$hash]);
    }
}