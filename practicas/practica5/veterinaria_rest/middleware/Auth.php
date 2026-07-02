<?php

require_once __DIR__ . '/../helpers/Token.php';

/**
 * Middleware de autenticacion. Se llama al inicio de cualquier
 * accion protegida del controlador correspondiente.
 */
class Auth
{
    /**
     * Verifica el token del header Authorization.
     * Si es valido devuelve el payload (id, username, ...).
     * Si no es valido, corta la ejecucion con un 401 en JSON.
     */
    public static function verificar()
    {
        $token = self::obtenerTokenDeHeader();
        $payload = Token::validar($token);

        if (!$payload) {
            http_response_code(401);
            echo json_encode([
                'error' => 'Token invalido, ausente o expirado'
            ]);
            exit;
        }

        return $payload;
    }

    private static function obtenerTokenDeHeader()
    {
        $authHeader = null;

        if (function_exists('getallheaders')) {
            $headers = getallheaders();

            foreach ($headers as $nombre => $valor) {
                if (strtolower($nombre) === 'authorization') {
                    $authHeader = $valor;
                    break;
                }
            }
        }

        // Fallback por si getallheaders() no existe en el SAPI usado
        if (!$authHeader && isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        }

        if (!$authHeader) {
            return null;
        }

        if (preg_match('/Bearer\s+(\S+)/i', $authHeader, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
