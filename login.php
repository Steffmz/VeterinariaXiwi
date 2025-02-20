<?php
session_start();
require_once 'includes/conexion.php';

if (isset($_SESSION['usuario_id'])) {
    header("Location: " . ($_SESSION['rol'] === 'admin' ? 'admin/dashboard.php' : 'usuario/dashboard.php'));
    exit();
}
?>
<!DOCTYPE html>
<!-- Formulario HTML con campos para email y password -->
<form action="procesar_login.php" method="POST">
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button type="submit">Ingresar</button>
</form>