<?php
session_start();
require_once 'includes/conexion.php';

if (isset($_SESSION['usuario_id'])) {
    header("Location: " . ($_SESSION['rol'] === 'admin' ? 'admin/dashboard.php' : 'usuario/dashboard.php'));
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Veterinaria</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form action="procesar_login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>