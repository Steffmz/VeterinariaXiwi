<?php
require_once 'auth_middleware.php';
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        
        $_SESSION['exito'] = "Usuario eliminado correctamente";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error al eliminar usuario";
    }
}

header("Location: gestion_usuarios.php");
exit();
?>