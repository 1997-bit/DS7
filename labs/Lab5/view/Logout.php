<?php
require_once "../config/session.php";

?>

<?php if (isset($_SESSION["usuario"])): ?>
 <div class="logout">
    <a href="../controller/Cerrasesion.php" 
       onclick="return confirm('¿Estás seguro que deseas cerrar sesión?')">
        Cerrar sesión
    </a>
</div>
<?php endif; ?>