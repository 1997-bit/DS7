<?php require_once __DIR__ . '/../config/session.php'; ?>
<?php include '_header.php'; ?>
<h3>Iniciar Sesión</h3>
<?php if(!empty($_SESSION['error'])){echo '<p class="error">'.htmlspecialchars($_SESSION['error']).'</p>'; unset($_SESSION['error']);} ?>
<form method="post" action="../controller/Auth.php">
  <input type="hidden" name="action" value="login">
  <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
  <label>Usuario o Email</label>
  <input name="user" required>
  <label>Contraseña</label>
  <input name="password" type="password" required>
  <button type="submit">Entrar</button>
</form>
<p class="small">¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
<?php include '_footer.php'; ?>
