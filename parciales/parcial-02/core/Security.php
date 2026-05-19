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

public static function checkRateLimit(string $key, int $maxIntentos = 5, int $ventanaSegundos = 300): void
{
    $ahora = time();
    $ip    = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $keyIp = $key . '_ip_' . md5($ip);

    // Verificar bloqueo por IP primero
    $datosIp = $_SESSION['rate_limit'][$keyIp]
        ?? ['intentos' => 0, 'desde' => $ahora, 'bloqueado_hasta' => 0];

    if ($datosIp['bloqueado_hasta'] > $ahora) {
        $restante = $datosIp['bloqueado_hasta'] - $ahora;
        http_response_code(429);
        die("Demasiados intentos. Intenta de nuevo en {$restante} segundos.");
    }

    if ($ahora - $datosIp['desde'] > $ventanaSegundos) {
        $datosIp = ['intentos' => 0, 'desde' => $ahora, 'bloqueado_hasta' => 0];
    }

    $datosIp['intentos']++;

    if ($datosIp['intentos'] >= $maxIntentos) {
        $datosIp['bloqueado_hasta'] = $ahora + $ventanaSegundos;
        $_SESSION['rate_limit'][$keyIp] = $datosIp;
        http_response_code(429);
        die("Demasiados intentos. Intenta de nuevo en {$ventanaSegundos} segundos.");
    }

    $_SESSION['rate_limit'][$keyIp] = $datosIp;
}

    public static function clearRateLimit(string $key): void
    {
        $ip    = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $keyIp = $key . '_ip_' . md5($ip);
        unset($_SESSION['rate_limit'][$keyIp]);
    }

}