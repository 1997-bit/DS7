<?php
require_once __DIR__ . "/../core/Security.php";
require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../models/Perfil.php";
require_once __DIR__ . "/../config/Conexion.php";

class AspiranteController {

    // Vistas

    public function login() {
        require BASE_PATH . 'view/aspirante/login.php';
    }

    public function registro() {
        require BASE_PATH . 'view/aspirante/registro.php';
    }

    public function formulario() {
        Security::requireAspiranteAuth();
        require BASE_PATH . 'view/aspirante/formulario.php';
    }

    public function home(): void {
        Security::requireAspiranteAuth();

        $pdo  = Conexion::Conectar();
        $stmt = $pdo->prepare("SELECT * FROM perfil WHERE id_usuario = ?");
        $stmt->execute([$_SESSION['aspirante_id']]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

        require BASE_PATH . 'view/aspirante/home.php';
    }

    public function editarperfil() {
        Security::requireAspiranteAuth();
        require BASE_PATH . 'view/aspirante/editarperfil.php';
    }

    // Acciones POST

    public function post_login(): void {
        $usuario   = $_POST['usuario']   ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        $model = new Usuario();
        $data  = $model->login($usuario, $contrasena);

        if (!$data) {
            header("Location: /login?error=credenciales");
            exit;
        }

        session_regenerate_id(true);
        $_SESSION['aspirante_id'] = $data['id'];
        $_SESSION['usuario']      = $data['usuario'];

        header((int)$data['perfil_completo'] === 0
            ? "Location: /formulario"
            : "Location: /home"
        );
        exit;
    }

    public function post_registro(): void {
        $usuario    = $_POST['usuario']    ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        if ($usuario === '' || $contrasena === '') {
            header("Location: /registro?error=empty");
            exit;
        }

        (new Usuario())->registrar($usuario, $contrasena);
        header("Location: /login?registro=ok");
        exit;
    }

    public function post_formulario(): void {
        Security::requireAspiranteAuth();

        $idUsuario = $_SESSION['aspirante_id'];
        $model     = new Perfil();

        $datos = [
            'cedula' => $_POST['documento'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'estado_civil' => $_POST['estado_civil'] ?? null,
            'genero' => $_POST['genero'],
            'tipo_sangre' => $_POST['sangre'] ?? null,
            'fecha_nacimiento' => $_POST['fecha_nacimiento'],
            'nacionalidad' => $_POST['nacionalidad'],
            'telefono' => $_POST['telefono'],
            'residencia' => $_POST['residencia'],
            'correo' => $_POST['correo'],
        ];

        $model->existe($idUsuario)
            ? $model->actualizar($idUsuario, $datos)
            : $model->crear($idUsuario, $datos);

        Conexion::Conectar()
            ->prepare("UPDATE usuario SET perfil_completo = 1 WHERE id = ?")
            ->execute([$idUsuario]);

        $_SESSION['perfil_completo'] = true;
        header("Location: /home");
        exit;
    }

    public function perfil(): void {
        Security::requireAspiranteAuth();

        $pdo  = Conexion::Conectar();
        $stmt = $pdo->prepare("SELECT * FROM perfil WHERE id_usuario = ?");
        $stmt->execute([$_SESSION['aspirante_id']]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

        require BASE_PATH . 'view/aspirante/perfil.php';
    }

    public function post_perfil(): void {
        Security::requireAspiranteAuth();

        $idUsuario = $_SESSION['aspirante_id'];
        $model     = new Perfil();

        $datos = [
            'cedula'           => $_POST['documento'],
            'nombre'           => $_POST['nombre'],
            'apellido'         => $_POST['apellido'],
            'estado_civil'     => $_POST['estado_civil']     ?? null,
            'genero'           => $_POST['genero'],
            'tipo_sangre'      => $_POST['sangre']           ?? null,
            'fecha_nacimiento' => $_POST['fecha_nacimiento'],
            'nacionalidad'     => $_POST['nacionalidad'],
            'telefono'         => $_POST['telefono'],
            'residencia'       => $_POST['residencia'],
            'correo'           => $_POST['correo'],
        ];

        $model->existe($idUsuario)
            ? $model->actualizar($idUsuario, $datos)
            : $model->crear($idUsuario, $datos);

        header("Location: /home");
        exit;
    }

}