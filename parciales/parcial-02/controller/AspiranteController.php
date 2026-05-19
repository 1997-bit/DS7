<?php
require_once __DIR__ . "/../core/Security.php";
require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../models/Perfil.php";
require_once __DIR__ . "/../config/Conexion.php";

class AspiranteController
{

    // Vistas

    public function login()
    {
        require BASE_PATH . 'view/aspirante/login.php';
    }

    public function registro()
    {
        require BASE_PATH . 'view/aspirante/registro.php';
    }

    public function formulario()
    {
        Security::requireAspiranteAuth();
        require BASE_PATH . 'view/aspirante/formulario.php';
    }

    public function home(): void
    {
        Security::requireAspiranteAuth();

        $pdo = Conexion::Conectar();
        $stmt = $pdo->prepare("SELECT * FROM perfil WHERE id_usuario = ?");
        $stmt->execute([$_SESSION['aspirante_id']]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

        require BASE_PATH . 'view/aspirante/home.php';
    }

    public function editarperfil()
    {
        Security::requireAspiranteAuth();
        require BASE_PATH . 'view/aspirante/editarperfil.php';
    }

    // Acciones POST

    public function post_login(): void
    {
        $usuario = $_POST['usuario'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        $model = new Usuario();
        $data = $model->login($usuario, $contrasena);

        if (!$data) {
            header("Location: /login?error=credenciales");
            exit;
        }

        session_regenerate_id(true);
        $_SESSION['aspirante_id'] = $data['id'];
        $_SESSION['usuario'] = $data['usuario'];

        header(
            (int) $data['perfil_completo'] === 0
            ? "Location: /formulario"
            : "Location: /home"
        );
        exit;
    }

    public function post_registro(): void
    {
        $usuario = $_POST['usuario'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        if ($usuario === '' || $contrasena === '') {
            header("Location: /registro?error=empty");
            exit;
        }

        (new Usuario())->registrar($usuario, $contrasena);
        header("Location: /login?registro=ok");
        exit;
    }

    public function post_formulario(): void
    {
        Security::requireAspiranteAuth();

        $idUsuario = $_SESSION['aspirante_id'];
        $model = new Perfil();

        $datos = [
            'tipo_doc' => $_POST['tipo_doc'] ?? 'cedula',
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

        $error = $this->validarDatos($datos);
        if ($error !== null) {
            header("Location: /formulario?error=$error");
            exit;
        }

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

    public function perfil(): void
    {
        Security::requireAspiranteAuth();

        $pdo = Conexion::Conectar();
        $stmt = $pdo->prepare("SELECT * FROM perfil WHERE id_usuario = ?");
        $stmt->execute([$_SESSION['aspirante_id']]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

        require BASE_PATH . 'view/aspirante/perfil.php';
    }

    public function post_perfil(): void
    {
        Security::requireAspiranteAuth();

        $idUsuario = $_SESSION['aspirante_id'];
        $model = new Perfil();

        $datos = [
            'tipo_doc' => $_POST['tipo_doc'] ?? 'cedula',
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

        $error = $this->validarDatos($datos);
        if ($error !== null) {
            header("Location: /perfil?error=$error");
            exit;
        }

        $model->existe($idUsuario)
            ? $model->actualizar($idUsuario, $datos)
            : $model->crear($idUsuario, $datos);

        header("Location: /home");
        exit;
    }
    // validaciones, mas seguridad que un required.
    private function validarDatos(array $datos): ?string
    {
        // Campos requeridos
        $requeridos = ['cedula', 'nombre', 'apellido', 'genero', 'fecha_nacimiento', 'nacionalidad', 'telefono', 'residencia', 'correo'];
        foreach ($requeridos as $campo) {
            if (empty($datos[$campo])) {
                return "empty";
            }
        }

        // Documento según tipo
        if ($datos['tipo_doc'] === 'cedula') {
            $regexCedula = '/^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,6})$/';
            if (!preg_match($regexCedula, $datos['cedula'])) {
                return "cedula";
            }
        } elseif ($datos['tipo_doc'] === 'pasaporte') {
            if (!preg_match('/^[A-Z0-9]{6,9}$/', strtoupper($datos['cedula']))) {
                return "pasaporte";
            }
        } else {
            return "tipo_doc";
        }

        // Edad mínima 18, máxima 100
        $fechaNac = new DateTime($datos['fecha_nacimiento']);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNac)->y;
        if ($edad < 18 || $edad > 100) {
            return "edad";
        }

        // Bloquear caracteres especiales en nombre, apellido, residencia
        $regexTexto = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';
        if (
            !preg_match($regexTexto, $datos['nombre']) ||
            !preg_match($regexTexto, $datos['apellido'])
        ) {
            return "caracteres";
        }

        // Correo válido
        if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            return "correo";
        }

        // Estado civil permitido
        $estadosCiviles = ['soltero', 'casado', 'divorciado', 'viudo', 'union_libre'];
        if (!empty($datos['estado_civil']) && !in_array($datos['estado_civil'], $estadosCiviles)) {
            return "estado_civil";
        }

        // Género permitido
        $generos = ['masculino', 'femenino'];
        if (!in_array($datos['genero'], $generos)) {
            return "genero";
        }

        // Tipo de sangre permitido
        $tiposSangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        if (!empty($datos['tipo_sangre']) && !in_array($datos['tipo_sangre'], $tiposSangre)) {
            return "sangre";
        }

        return null; // Sin errores
    }

    public function logout(): void
    {

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        Security::redirect('/login');
    }

}