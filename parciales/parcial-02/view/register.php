<?php require_once __DIR__ . '/../config/session.php'; ?>
<?php include '_header.php'; ?>
<h3>Registro de Aspirante</h3>
<?php if(!empty($_SESSION['error'])){echo '<p class="error">'.htmlspecialchars($_SESSION['error']).'</p>'; unset($_SESSION['error']);} ?>
<form method="post" action="../controller/Auth.php" onsubmit="return validateRegister()">
  <input type="hidden" name="action" value="register">
  <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
  <label>Usuario</label>
  <input id="username" name="username" required>
  <label>Email</label>
  <input id="email" name="email" type="email" required>
  <label>Contraseña (mín 15 caracteres)</label>
  <input id="password" name="password" type="password" required>
  <p id="reg_error" class="error"></p>
  <button type="submit">Registrar</button>
</form>
<p class="small">¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
<?php include '_footer.php'; ?>
