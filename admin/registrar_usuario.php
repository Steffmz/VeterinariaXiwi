<?php
require_once 'auth_middleware.php';
require_once '../includes/conexion.php';
require_once '../includes/funciones.php';

$errores = [];
$exito = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = limpiar_input($_POST['nombre']);
    $email = limpiar_input($_POST['email']);
    $usuario = limpiar_input($_POST['usuario']);
    $password = $_POST['password'];
    $rol = limpiar_input($_POST['rol']);

    // Validar unicidad
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? OR usuario = ?");
    $stmt->execute([$email, $usuario]);
    
    if ($stmt->rowCount() > 0) {
        $errores[] = "El email o usuario ya está registrado";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, usuario, password, rol) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $email, $usuario, $password_hash, $rol]);
            
            $_SESSION['exito'] = "Usuario creado exitosamente";
            header("Location: gestion_usuarios.php");
            exit();
        } catch(PDOException $e) {
            $errores[] = "Error al crear usuario: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<!-- Formulario HTML -->
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="usuario" placeholder="Nombre de usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <select name="rol" required>
        <option value="usuario">Usuario</option>
        <option value="admin">Administrador</option>
    </select>
    <button type="submit">Registrar</button>
</form>