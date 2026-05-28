<?php

session_start();

if (!isset($_SESSION['usuario_id']) && basename($_SERVER['PHP_SELF']) !== 'Login.php' && basename($_SERVER['PHP_SELF']) !== 'Registro.php') {
    header("Location: Login.php");
    exit;
}
