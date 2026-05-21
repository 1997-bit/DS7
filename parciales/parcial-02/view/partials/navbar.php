<nav style="display:flex;justify-content:space-between;padding:10px;">
    <div>Portal RH</div>

    <div>
        Usuario: <?= htmlspecialchars($_SESSION['rh'] ?? '') ?>
        | 
        <form method="POST" action="/rh/login" style="display:inline;">
            <input type="hidden" name="csrf_token" value="<?= Security::generarCsrfToken() ?>">
            <button type="submit" style="background:none;border:none;cursor:pointer;color:inherit;padding:0;">
                Salir
            </button>
        </form>
    </div>
</nav>