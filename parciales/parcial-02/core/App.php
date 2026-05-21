<?php

class App
{

    public static function run(): void
    {

        session_start();

        $timeout = 1800;

        if (isset($_SESSION['LAST_ACTIVITY'])) {

            if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout) {

                session_unset();
                session_destroy();

                header("Location: /login?error=sesion");
                exit;
            }
        }

        $_SESSION['LAST_ACTIVITY'] = time();

        define('BASE_PATH', realpath(__DIR__ . '/..') . '/');

        require BASE_PATH . 'config/Conexion.php';
        require BASE_PATH . 'core/Router.php';
        require BASE_PATH . 'core/Security.php';

        (new Router())->dispatch();
    }
}

?>