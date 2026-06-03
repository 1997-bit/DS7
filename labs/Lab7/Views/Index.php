<?php 
//Interfaz de usuario para enviar los números y mostrar el resultado procesado
require_once "../Controllers/SoapController.php";
$controller = new SoapController();
$resultado = $controller->ejecutarOperacion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../Assets/css/style.css">
    <title>Calculadora SOAP</title>
</head>
<body>
    <div class="card">
        <h1>Laboratorio 7: SOAP</h1>
        <form method="POST">
            <input type="number" step="any" name="n1" required placeholder="Valor A">
            <select name="operacion">
                <option value="sumar">+</option><option value="restar">-</option>
                <option value="multiplicar">*</option><option value="dividir">/</option>
            </select>
            <input type="number" step="any" name="n2" required placeholder="Valor B">
            <button type="submit">Calcular</button>
        </form>
        <?php if ($resultado !== null): ?>
            <div class="res">Resultado: <?php echo htmlspecialchars($resultado); ?></div>
        <?php endif; ?>
    </div>
</body>
</html>