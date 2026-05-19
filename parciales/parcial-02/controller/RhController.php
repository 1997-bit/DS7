<?php

class RhController {

    private function guard() {
        if (!isset($_SESSION['rh'])) {
            header('Location: /rh/login');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /rh/login');
        exit;
    }

    public function login() {
        require BASE_PATH.'view/rh/login.php';
    }

    public function post_login() {
        Security::validarCsrfToken();
        Security::checkRateLimit('login_rh');
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        $db = Conexion::Conectar();
        $stmt = $db->prepare("SELECT * FROM rh_usuario WHERE id_usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();

        if ($user && password_verify($contrasena, $user['contrasena'])) {
            Security::clearRateLimit('login_rh');
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
}