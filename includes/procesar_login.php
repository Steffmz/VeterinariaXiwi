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
                
                header("Location: " . ($usuario['rol'] === 'admin' ? 'admin/dashboard.php' : 'usuario/dashboard.php'));
                exit();
            }
        }
        
        $_SESSION['error'] = "Credenciales inválidas";
        header("Location: index.php");
        exit();
        
    } catch(PDOException $e) {
        die("Error en el login: " . $e->getMessage());
    }
}
?>