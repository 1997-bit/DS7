<?php

class Security
{
    public static function requirePerfilIncompleto(): void {
        if (self::perfilCompleto()) {
            self::redirect('/home');
        }
    }

    public static function requirePerfilCompleto(): void 
    {
        if (!self::perfilCompleto()) {
            self::redirect('/formulario');
        }
    }

    private static function perfilCompleto(): bool {
        $id = $_SESSION['aspirante_id'] ?? null;
        if (!$id) return false;

        $stmt = Conexion::Conectar()->prepare(
            "SELECT perfil_completo FROM aspirantes WHERE id=?"
        );
        $stmt->execute([$id]);

        return (bool) $stmt->fetchColumn();
    }

    public static function requireAspiranteAuth(): void
    {
        if (empty($_SESSION['aspirante_id'])) {
            header("Location: /login");
            exit;
        }
    }
    public static function redirect(string $url): void {
        header("Location: $url");
        exit;
    }
}