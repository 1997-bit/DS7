<?php require_once __DIR__ . '/../config/session.php'; ?>
<?php include '_header.php'; ?>
<?php if(empty($_SESSION['user_id'])){ header('Location: login.php'); exit; } ?>
<h3>Formulario de Aspirante</h3>
<?php if(!empty($_SESSION['success'])){echo '<p class="small">'.htmlspecialchars($_SESSION['success']).'</p>'; unset($_SESSION['success']);} ?>
<?php require_once __DIR__ . '/../model/Applicant.php'; $app=Applicant::findByUserId($_SESSION['user_id']); ?>
<form method="post" action="../controller/ApplicantController.php" onsubmit="return validateApplicant()">
  <input type="hidden" name="action" value="save">
  <input type="hidden" name="csrf" value="<?php echo csrf_token(); ?>">
  <label>Cédula o Pasaporte (obligatorio)</label>
  <input id="cedula" name="cedula" value="<?php echo htmlspecialchars($app['cedula']??''); ?>" required>
  <label>Nombre (obligatorio)</label>
  <input id="nombre" name="nombre" value="<?php echo htmlspecialchars($app['nombre']??''); ?>" required>
  <label>Apellido (obligatorio)</label>
  <input id="apellido" name="apellido" value="<?php echo htmlspecialchars($app['apellido']??''); ?>" required>
  <label>Estado civil</label>
  <input name="estado_civil" value="<?php echo htmlspecialchars($app['estado_civil']??''); ?>">
  <label>Género (obligatorio)</label>
  <select id="genero" name="genero" required>
    <option value="">--</option>
    <option value="Masculino" <?php if(($app['genero']??'')=='Masculino') echo 'selected'; ?>>Masculino</option>
    <option value="Femenino" <?php if(($app['genero']??'')=='Femenino') echo 'selected'; ?>>Femenino</option>
    <option value="Otro" <?php if(($app['genero']??'')=='Otro') echo 'selected'; ?>>Otro</option>
  </select>
  <label>Tipo de sangre</label>
  <input name="tipo_sangre" value="<?php echo htmlspecialchars($app['tipo_sangre']??''); ?>">
  <label>Fecha de nacimiento (obligatorio)</label>
  <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="<?php echo htmlspecialchars($app['fecha_nacimiento']??''); ?>" required>
  <label>Nacionalidad (obligatorio)</label>
  <input id="nacionalidad" name="nacionalidad" value="<?php echo htmlspecialchars($app['nacionalidad']??''); ?>" required>
  <label>Teléfono (obligatorio)</label>
  <input id="telefono" name="telefono" value="<?php echo htmlspecialchars($app['telefono']??''); ?>" required>
  <label>Residencia (obligatorio)</label>
  <textarea id="residencia" name="residencia" required><?php echo htmlspecialchars($app['residencia']??''); ?></textarea>
  <label>Correo electrónico (obligatorio)</label>
  <input id="correo" name="correo" type="email" value="<?php echo htmlspecialchars($app['correo']??''); ?>" required>
  <p id="form_error" class="error"></p>
  <button type="submit">Guardar</button>
</form>
<?php include '_footer.php'; ?>
