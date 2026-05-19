<?php require_once __DIR__ . '/../config/session.php'; ?>
<?php if(($_SESSION['role'] ?? '') !== 'rh'){ header('Location: login.php'); exit; } ?>
<?php include '_header.php'; ?>
<h3>Panel Recursos Humanos</h3>
<?php require_once __DIR__ . '/../model/Applicant.php'; $rows=Applicant::getAll(); ?>
<table>
  <thead><tr><th>Usuario</th><th>Nombre</th><th>Cédula</th><th>Teléfono</th><th>Correo</th><th>Estado</th><th>Acción</th></tr></thead>
  <tbody>
  <?php foreach($rows as $r): ?>
    <tr>
      <td><?php echo htmlspecialchars($r['username']); ?></td>
      <td><?php echo htmlspecialchars($r['nombre'].' '.$r['apellido']); ?></td>
      <td><?php echo htmlspecialchars($r['cedula']); ?></td>
      <td><?php echo htmlspecialchars($r['telefono']); ?></td>
      <td><?php echo htmlspecialchars($r['correo']); ?></td>
      <td><span class="status <?php echo str_replace(' ','_',trim($r['estado'])); ?>"><?php echo htmlspecialchars($r['estado']); ?></span></td>
      <td>
        <form method="post" action="../controller/ApplicantController.php" style="display:inline">
          <input type="hidden" name="action" value="change_status">
          <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
          <select name="status">
            <option value="no revisado" <?php if($r['estado']=='no revisado') echo 'selected'; ?>>no revisado</option>
            <option value="no considerado" <?php if($r['estado']=='no considerado') echo 'selected'; ?>>no considerado</option>
            <option value="considerado" <?php if($r['estado']=='considerado') echo 'selected'; ?>>considerado</option>
          </select>
          <button type="submit">Cambiar</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include '_footer.php'; ?>
