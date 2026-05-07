<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    // Guardar el nombre en una cookie válida por 5 minutos
    setcookie("nombre_usuario", $nombre, time() + 300); // 300 segundos = 5 minutos
    // Redirigir a la página de bienvenida
    header("Location: bienvenida.php");
    exit();
} else {
    // Si no se ha enviado el formulario, redirigir al formulario
    header("Location: Formulario.php");
    exit();
}
?>