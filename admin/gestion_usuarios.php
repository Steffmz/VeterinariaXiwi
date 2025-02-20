<?php
require_once 'auth_middleware.php';
require_once '../includes/conexion.php';

// Obtener todos los usuarios
$stmt = $conn->query("SELECT id, nombre, email, usuario, rol FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<table>
    <tr>
        <th>Nombre</th>
        <th>Email</th>
th>Usuario</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
        <td><?= htmlspecialchars($usuario['email']) ?></td>
        <td><?= htmlspecialchars($usuario['usuario']) ?></td>
        <td><?= $usuario['rol'] ?></td>
        <td>
            <a href="editar_usuario.php?id=<?= $usuario['id'] ?>">Editar</a>
            <form action="procesar_eliminar_usuario.php" method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                <button type="submit" onclick="return confirm('¿Eliminar usuario?')">Eliminar</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>