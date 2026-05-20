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
    public static function generarCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validarCsrfToken(): void
    {
        $token = $_POST['csrf_token'] ?? '';
        if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            http_response_code(403);
            require BASE_PATH . 'view/errors/403.php';
            exit;
        }
        // Rotar token después de validar
        unset($_SESSION['csrf_token']);
    }

public static function checkRateLimit(string $rol, string $usuario, int $maxIntentos = 5, int $ventanaSegundos = 300): void
{
    $pdo = Conexion::Conectar();

    $pdo->prepare("
        DELETE FROM login_attempts
        WHERE identifier = ? AND ip = ?
          AND attempted_at < DATE_SUB(NOW(), INTERVAL ? SECOND)
    ")->execute([$usuario, $rol, $ventanaSegundos]);

    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM login_attempts
        WHERE identifier = ? AND ip = ?
          AND attempted_at >= DATE_SUB(NOW(), INTERVAL ? SECOND)
    ");
    $stmt->execute([$usuario, $rol, $ventanaSegundos]);

    if ((int) $stmt->fetchColumn() >= $maxIntentos) {
        http_response_code(429);
        die("Demasiados intentos para este usuario. Intenta en {$ventanaSegundos} segundos.");
    }

    $pdo->prepare("
        INSERT INTO login_attempts (identifier, ip, attempted_at)
        VALUES (?, ?, NOW())
    ")->execute([$usuario, $rol]);
}

public static function clearRateLimit(string $rol, string $usuario): void
{
    $pdo = Conexion::Conectar();
    $pdo->prepare("
        DELETE FROM login_attempts WHERE identifier = ? AND ip = ?
    ")->execute([$usuario, $rol]);
}

}