<?php
require_once __DIR__ . "/../core/Security.php";
require_once __DIR__ . "/../models/Usuario.php";
require_once __DIR__ . "/../models/Perfil.php";
require_once __DIR__ . "/../config/Conexion.php";

class AspiranteController
{

    // Vistas

<<<<<<< HEAD
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
=======
    public function login()
    {
        if (isset($_SESSION['rh'])) {
            $_SESSION = [];

            if (ini_get('session.use_cookies')) {
                $params = session_get_cookie_params();

                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params['path'],
                    $params['domain'],
                    $params['secure'],
                    $params['httponly']
                );
            }

            session_regenerate_id(true);
            session_destroy();
        }

        require BASE_PATH . 'view/aspirante/login.php';
>>>>>>> origin/gloria
    }
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
<<<<<<< HEAD
=======

>>>>>>> origin/gloria
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

<<<<<<< HEAD
public function post_login(): void
{
    Security::validarCsrfToken();
    $usuario    = $_POST['usuario']    ?? '';   // ← primero
    $contrasena = $_POST['contrasena'] ?? '';

    Security::checkRateLimit('aspirante', $usuario);  // ← luego
=======
    public function post_login(): void
    {
        Security::validarCsrfToken();

        $usuario = $_POST['usuario'] ?? '';
        $contrasena = $_POST['contrasena'] ?? '';

        Security::checkRateLimit('aspirante', $usuario);

        $model = new Usuario();
        $data = $model->login($usuario, $contrasena);
>>>>>>> origin/gloria

    $model = new Usuario();
    $data  = $model->login($usuario, $contrasena);

<<<<<<< HEAD
    if (!$data) {
        header("Location: /login?error=credenciales");
        exit;
    }

    Security::clearRateLimit('aspirante', $usuario);
    session_regenerate_id(true);
    $_SESSION['aspirante_id'] = $data['id'];
    $_SESSION['usuario']      = $data['usuario'];

    header(
        (int) $data['perfil_completo'] === 0
        ? "Location: /formulario"
        : "Location: /home"
    );
    exit;
}

    public function post_registro(): void
    {
        Security::validarCsrfToken();
        $usuario   = $_POST['usuario']   ?? '';
=======
        Security::clearRateLimit('aspirante', $usuario);

        session_regenerate_id(true);

        $_SESSION['aspirante_id'] = $data['id'];
        $_SESSION['usuario'] = $data['usuario'];

        header(
            (int)$data['perfil_completo'] === 0
                ? "Location: /formulario"
                : "Location: /home"
        );

        exit;
    }

    public function post_registro(): void
    {
        Security::validarCsrfToken();

        $usuario = $_POST['usuario'] ?? '';
>>>>>>> origin/gloria
        $contrasena = $_POST['contrasena'] ?? '';

        if ($usuario === '' || $contrasena === '') {
            header("Location: /registro?error=empty");
            exit;
        }

        $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{15,}$/';
<<<<<<< HEAD
=======

>>>>>>> origin/gloria
        if (!preg_match($patron, $contrasena)) {
            header("Location: /registro?error=contrasena");
            exit;
        }

        (new Usuario())->registrar($usuario, $contrasena);

        header("Location: /login?registro=ok");
        exit;
    }

    public function post_formulario(): void
    {
        Security::requireAspiranteAuth();
        Security::validarCsrfToken();

        $idUsuario = $_SESSION['aspirante_id'];
<<<<<<< HEAD
=======

>>>>>>> origin/gloria
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
<<<<<<< HEAD
=======

>>>>>>> origin/gloria
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
<<<<<<< HEAD
        http_response_code(404);
        require BASE_PATH . 'view/errors/404.php';
        exit;
=======
        Security::requireAspiranteAuth();

        $pdo = Conexion::Conectar();

        $stmt = $pdo->prepare("SELECT * FROM perfil WHERE id_usuario = ?");

        $stmt->execute([$_SESSION['aspirante_id']]);

        $perfil = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

        require BASE_PATH . 'view/aspirante/perfil.php';
>>>>>>> origin/gloria
    }

    public function post_perfil(): void
    {
        Security::requireAspiranteAuth();
<<<<<<< HEAD
        Security::validarCsrfToken(); 

        $idUsuario = $_SESSION['aspirante_id'];
=======
        Security::validarCsrfToken();

        $idUsuario = $_SESSION['aspirante_id'];

>>>>>>> origin/gloria
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
<<<<<<< HEAD
        if ($error !== null) {
            header("Location: /home?error=$error");
=======

        if ($error !== null) {
            header("Location: /perfil?error=$error");
>>>>>>> origin/gloria
            exit;
        }

        $model->existe($idUsuario)
            ? $model->actualizar($idUsuario, $datos)
            : $model->crear($idUsuario, $datos);

<<<<<<< HEAD
        header("Location: /home?updated=ok"); 
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

=======
        header("Location: /home?updated=ok");
        exit;
    }

    // validaciones, mas seguridad que un required.
    private function validarDatos(array $datos): ?string
    {
        // Campos requeridos
        $requeridos = [
            'cedula',
            'nombre',
            'apellido',
            'genero',
            'fecha_nacimiento',
            'nacionalidad',
            'telefono',
            'residencia',
            'correo'
        ];

        foreach ($requeridos as $campo) {
            if (empty($datos[$campo])) {
                return "empty";
            }
        }

>>>>>>> origin/gloria
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
<<<<<<< HEAD
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNac)->y;
=======

        $hoy = new DateTime();

        $edad = $hoy->diff($fechaNac)->y;

>>>>>>> origin/gloria
        if ($edad < 18 || $edad > 100) {
            return "edad";
        }

<<<<<<< HEAD
        // Bloquear caracteres especiales en nombre, apellido, residencia
        $regexTexto = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';
=======
        // Bloquear caracteres especiales en nombre y apellido
        $regexTexto = '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/';

>>>>>>> origin/gloria
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
<<<<<<< HEAD
        $estadosCiviles = ['soltero', 'casado', 'divorciado', 'viudo', 'union_libre'];
        if (!empty($datos['estado_civil']) && !in_array($datos['estado_civil'], $estadosCiviles)) {
=======
        $estadosCiviles = [
            'soltero',
            'casado',
            'divorciado',
            'viudo',
            'union_libre'
        ];

        if (
            !empty($datos['estado_civil']) &&
            !in_array($datos['estado_civil'], $estadosCiviles)
        ) {
>>>>>>> origin/gloria
            return "estado_civil";
        }

        // Género permitido
        $generos = ['masculino', 'femenino'];
<<<<<<< HEAD
=======

>>>>>>> origin/gloria
        if (!in_array($datos['genero'], $generos)) {
            return "genero";
        }

        // Tipo de sangre permitido
<<<<<<< HEAD
        $tiposSangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        if (!empty($datos['tipo_sangre']) && !in_array($datos['tipo_sangre'], $tiposSangre)) {
            return "sangre";
        }

        return null; // Sin errores
=======
        $tiposSangre = [
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-',
            'O+',
            'O-'
        ];

        if (
            !empty($datos['tipo_sangre']) &&
            !in_array($datos['tipo_sangre'], $tiposSangre)
        ) {
            return "sangre";
        }

        return null;
>>>>>>> origin/gloria
    }

    public function logout(): void
    {
<<<<<<< HEAD

=======
>>>>>>> origin/gloria
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

<<<<<<< HEAD
        header("Location: /login");
        exit;
    }

=======
        Security::redirect('/login');
    }
>>>>>>> origin/gloria
}