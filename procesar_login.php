<?php
session_start();
require_once 'includes/conexion.php';
require_once 'includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = limpiar_input($_POST['email']);
    $password = limpiar_input($_POST['password']);
    
    try {
        $stmt = $conn->prepare("SELECT id, password, rol FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() === 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $usuario['password'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['rol'] = $usuario['rol'];
                
                // Redirección absoluta
                $redirect = ($usuario['rol'] === 'admin') 
                        ? '/VeterinariaXiwi/admin/dashboard.php' 
                        : '/VeterinariaXiwi/usuario/dashboard.php';
                
                header("Location: http://localhost" . $redirect);
                exit();
            }
        }
        
        $_SESSION['error'] = "Credenciales incorrectas";
        header("Location: /VeterinariaXiwi/index.php");
        exit();
        
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}

// Si no es POST, redirige
header("Location: /VeterinariaXiwi/index.php");
exit();
?>