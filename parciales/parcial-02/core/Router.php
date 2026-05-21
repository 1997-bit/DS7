<?php
class Router {

    public function dispatch(): void
    {
        $uri = trim($_GET['url'] ?? 'login', '/');

        if ($uri === '') {
            $uri = 'login';
        }

        $parts = explode('/', $uri);

        if ($parts[0] === 'rh') {
            $controllerName = 'RhController';
            $method = $parts[1] ?? 'home';
            $params = array_slice($parts, 2);
        } else {
            $controllerName = 'AspiranteController';
            $method = $parts[0] ?? 'login';
            $params = array_slice($parts, 1);
        }

        // Si es POST, busca post_login, post_registro, etc.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $method = 'post_' . $method;
        }

        $file = BASE_PATH . "controller/$controllerName.php";

        if (!file_exists($file)) {
            http_response_code(404);
            require BASE_PATH . 'view/errors/404.php';
            exit;
        }

        require $file;
        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            require BASE_PATH . 'view/errors/404.php';
            exit;
        }

        call_user_func_array([$controller, $method], $params);
    }
}