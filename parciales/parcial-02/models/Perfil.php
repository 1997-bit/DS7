<?php
require_once __DIR__ . "/../config/conexion.php";

class Perfil
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::Conectar();
    }

    /** Crea el perfil del aspirante. */
    public function crear(int $idUsuario, array $datos): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO perfil
                (id_usuario, cedula, nombre, apellido, estado_civil, genero,
                 tipo_sangre, fecha_nacimiento, nacionalidad, telefono,
                 residencia, correo)
             VALUES
                (:id_usuario, :cedula, :nombre, :apellido, :estado_civil, :genero,
                 :tipo_sangre, :fecha_nacimiento, :nacionalidad, :telefono,
                 :residencia, :correo)"
        );
        $stmt->execute([
            ':id_usuario'      => $idUsuario,
            ':cedula'          => $datos['cedula'],
            ':nombre'          => $datos['nombre'],
            ':apellido'        => $datos['apellido'],
            ':estado_civil'    => $datos['estado_civil']     ?? null,
            ':genero'          => $datos['genero'],
            ':tipo_sangre'     => $datos['tipo_sangre']      ?? null,
            ':fecha_nacimiento'=> $datos['fecha_nacimiento'],
            ':nacionalidad'    => $datos['nacionalidad'],
            ':telefono'        => $datos['telefono'],
            ':residencia'      => $datos['residencia'],
            ':correo'          => $datos['correo'],
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    // Actualiza el perfil
    public function actualizar(int $idUsuario, array $datos): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE perfil SET
                cedula = :cedula,
                nombre = :nombre,
                apellido = :apellido,
                estado_civil = :estado_civil,
                genero = :genero,
                tipo_sangre = :tipo_sangre,
                fecha_nacimiento = :fecha_nacimiento,
                nacionalidad = :nacionalidad,
                telefono = :telefono,
                residencia = :residencia,
                correo = :correo
            WHERE id_usuario = :id_usuario"
        );

        return $stmt->execute([
            ':id_usuario' => $idUsuario,
            ':cedula' => $datos['cedula'],
            ':nombre' => $datos['nombre'],
            ':apellido' => $datos['apellido'],
            ':estado_civil' => $datos['estado_civil'] ?? null,
            ':genero' => $datos['genero'],
            ':tipo_sangre' => $datos['tipo_sangre'] ?? null,
            ':fecha_nacimiento' => $datos['fecha_nacimiento'],
            ':nacionalidad' => $datos['nacionalidad'],
            ':telefono' => $datos['telefono'],
            ':residencia' => $datos['residencia'],
            ':correo' => $datos['correo'],
        ]);
    }

    /** Obtiene el perfil por id_usuario. Retorna array o null. */
    public function obtenerPorUsuario(int $idUsuario): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM perfil WHERE id_usuario = :id_usuario LIMIT 1"
        );
        $stmt->execute([':id_usuario' => $idUsuario]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    /** ¿El usuario ya tiene perfil creado? */
    public function existe(int $idUsuario): bool
    {
        $stmt = $this->pdo->prepare(
            "SELECT 1 FROM perfil WHERE id_usuario = :id_usuario LIMIT 1"
        );
        $stmt->execute([':id_usuario' => $idUsuario]);
        return (bool) $stmt->fetchColumn();
    }
}
