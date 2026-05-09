<?php
// Eliminar la cookie estableciendo su tiempo de expiración en el pasado
setcookie("nombre_usuario", "", time() - 3600); // 3600 segundos
// Redirigir al formulario
header("Location: Formulario.php");
exit();
?>