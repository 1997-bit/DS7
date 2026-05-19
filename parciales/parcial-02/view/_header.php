<?php require_once __DIR__ . '/../config/session.php'; ?>
<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="../assets/css/style.css">
<script src="../assets/js/validation.js"></script>
</head><body>
<div class="container">
<div style="display:flex;justify-content:space-between;align-items:center"><h2>Sistema RH</h2>
<?php if(!empty($_SESSION['username'])): ?>
  <div>Usuario: <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="../controller/Auth.php?action=logout">Salir</a></div>
<?php endif; ?></div>
<hr>
