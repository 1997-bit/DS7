<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Gestor de Tareas</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        form { max-width: 300px; }
        input, button { width: 100%; padding: 8px; margin: 8px 0; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    
    <form method="POST" action="../controller/AuthController.php">
        <input type="hidden" name="accion" value="login">
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Contraseña:</label>
        <input type="password" name="contrasena" required>
        
        <button type="submit">Entrar</button>
    </form>
    
    <p>¿No tienes cuenta? <a href="Registro.php">Crear cuenta</a></p>
</body>
</html>
