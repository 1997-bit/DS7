<nav style="display:flex;justify-content:space-between;padding:10px;">
    <div>Portal RH</div>

    <div>
        Usuario: <?= htmlspecialchars($_SESSION['usuario'] ?? '') ?>
        | <a href="/perfil">Editar</a>
        | <a href="/logout">Salir</a>
    </div>
</nav>