<?php

class RhController {

    public function login() {
        require BASE_PATH.'view/rh/login.php';
    }

    public function home() {
        require BASE_PATH.'view/rh/home.php';
    }

    public function detalle($id = null) {
        require BASE_PATH.'view/rh/detalle.php';
    }
}