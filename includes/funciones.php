<?php
function proteger_ruta() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: ../index.php");
        exit();
    }
}

function es_admin() {
    return ($_SESSION['rol'] === 'admin');
}

// Función para sanitizar datos
function limpiar_input($data) {
    return htmlspecialchars(trim($data));
}
?>