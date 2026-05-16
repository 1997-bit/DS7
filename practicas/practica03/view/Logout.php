<?php

?>

<?php if (isset($_SESSION["usuario"])): ?>
<div class="logout">
    <button onclick="if(confirm('¿Estás seguro que deseas cerrar sesión?')) window.location.href='../controller/Cerrasesion.php'">
        Cerrar sesión
    </button>
</div>
<?php endif; ?>