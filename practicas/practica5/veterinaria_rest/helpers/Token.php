<?php

/**
 * Generador y validador de tokens estilo JWT (header.payload.firma)
 * usando HMAC-SHA256. No requiere librerias externas, ideal para
 * un laboratorio academico.
 */
class Token
{
    // En un proyecto real esta clave debe ir en una variable de entorno,
    // nunca en el codigo fuente.
    private static $secreto = "veterinaria_lab9_clave_secreta_2026";

    // Tiempo de vida del token en segundos (1 hora)
    private static $expiracion = 3600;

    private static function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode($data)
    {
        $resto = strlen($data) % 4;

        if ($resto) {
            $data .= str_repeat('=', 4 - $resto);
        }

        return base64_decode(strtr($data, '-_', '+/'));
    }

    /**
     * Genera un token firmado a partir de un payload (ej. id y username)
     */
    public static function generar(array $payload)
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $payload['iat'] = time();
        $payload['exp'] = time() + self::$expiracion;

        $headerCod = self::base64UrlEncode(json_encode($header));
        $payloadCod = self::base64UrlEncode(json_encode($payload));

        $firma = hash_hmac(
            'sha256',
            "$headerCod.$payloadCod",
            self::$secreto,
            true
        );

        $firmaCod = self::base64UrlEncode($firma);

        return "$headerCod.$payloadCod.$firmaCod";
    }

    /**
     * Valida la firma y expiracion del token.
     * Devuelve el payload decodificado si es valido, o false si no lo es.
     */
    public static function validar($token)
    {
        if (!$token) {
            return false;
        }

        $partes = explode('.', $token);

        if (count($partes) !== 3) {
            return false;
        }

        list($headerCod, $payloadCod, $firmaCod) = $partes;

        $firmaEsperada = hash_hmac(
            'sha256',
            "$headerCod.$payloadCod",
            self::$secreto,
            true
        );

        $firmaEsperadaCod = self::base64UrlEncode($firmaEsperada);

        // hash_equals evita ataques de "timing"
        if (!hash_equals($firmaEsperadaCod, $firmaCod)) {
            return false;
        }

        $payload = json_decode(
            self::base64UrlDecode($payloadCod),
            true
        );

        if (!is_array($payload) || !isset($payload['exp'])) {
            return false;
        }

        if ($payload['exp'] < time()) {
            return false;
        }

        return $payload;
    }
}
