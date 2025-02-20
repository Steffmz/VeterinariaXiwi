<?php
require_once 'auth_middleware.php';
require_once '../includes/conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel Admin</title>
</head>
<body>
    <h1>Bienvenido Administrador</h1>
    
    <!-- Menú rápido -->
    <nav>
        <a href="registrar_usuario.php">Nuevo Usuario</a>
        <a href="gestion_usuarios.php">Gestión Usuarios</a>
        <a href="logout.php">Cerrar Sesión</a>
    </nav>

    <?php if(isset($_SESSION['exito'])): ?>
        <div class="notificacion"><?= $_SESSION['exito']; unset($_SESSION['exito']); ?></div>
    <?php endif; ?>
</body>
</html>