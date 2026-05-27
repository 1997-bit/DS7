<?php

class RhController {

    private function guard() {
        if (!isset($_SESSION['rh'])) {
            header('Location: /rh/login');
            exit;
        }
    }

    public function logout() {
        // 1. Vaciar el array de sesión
        $_SESSION = [];

        // 2. Destruir la cookie en el cliente
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }

        // 3. Regenerar el ID antes de destruir (evita session fixation)
        session_regenerate_id(true);

        // 4. Destruir la sesión en el servidor
        session_destroy();

        header('Location: /rh/login');
        exit;
    }

        public function login() {
            if (isset($_SESSION['rh'])) {
                $_SESSION = [];
                if (ini_get('session.use_cookies')) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params['path'], $params['domain'],
                        $params['secure'], $params['httponly']);
                }
                session_regenerate_id(true);
                session_destroy();
            }
            require BASE_PATH.'view/rh/login.php';
        }
            public function post_login() {
        Security::validarCsrfToken();
        $usuario    = $_POST['usuario']    ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        Security::checkRateLimit('admin', $usuario);

        $db = Conexion::Conectar();
        $stmt = $db->prepare("SELECT * FROM rh_usuario WHERE id_usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();

        if ($user && password_verify($contrasena, $user['contrasena'])) {
            Security::clearRateLimit('admin', $usuario);
            $_SESSION['rh'] = $usuario;
            header('Location: /rh/home');
            exit;
        } else {
            header('Location: /rh/login?error=credenciales');
            exit;
        }
    }

    public function home() {
        $this->guard();

        // Evitar que el navegador cachee esta página
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');

        $db = Conexion::Conectar();
        $stmt = $db->prepare("
            SELECT p.id, p.nombre, p.apellido, p.correo, p.estado,
                   p.cedula, p.telefono, p.residencia, p.fecha_nacimiento,
                   p.estado_civil, p.genero, p.nacionalidad
            FROM perfil p
            JOIN usuario u ON p.id_usuario = u.id
        ");
        $stmt->execute();
        $aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require BASE_PATH.'view/rh/home.php';
    }

    public function detalle($id = null) {
        $this->guard();
        require BASE_PATH.'view/rh/detalle.php';
    }
    public function post_actualizar_estado(): void
    {
        $this->guard();

        $body  = json_decode(file_get_contents('php://input'), true);
        $id    = (int)($body['id'] ?? 0);
        $estado = $body['estado'] ?? '';

        $permitidos = ['no_revisado', 'considerado', 'no_considerado'];
        if (!in_array($estado, $permitidos, true) || $id <= 0) {
            http_response_code(400);
            echo json_encode(['ok' => false, 'error' => 'Datos inválidos']);
            exit;
        }

        $db = Conexion::Conectar();
        $stmt = $db->prepare("UPDATE perfil SET estado = ? WHERE id = ?");
        $stmt->execute([$estado, $id]);

        echo json_encode(['ok' => true]);
    }
}