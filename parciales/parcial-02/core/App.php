<?php

class App {
    public static function run(): void {
        session_start();
        define('BASE_PATH', realpath(__DIR__.'/..').'/');

        require BASE_PATH.'config/Conexion.php';
        require BASE_PATH.'core/Router.php';
        require BASE_PATH.'core/Security.php';
        (new Router())->dispatch();
    }
}