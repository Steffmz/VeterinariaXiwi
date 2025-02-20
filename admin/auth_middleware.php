<?php
session_start();
require_once '../includes/funciones.php';

proteger_ruta();

if (!es_admin()) {
    header("Location: ../usuario/dashboard.php");
    exit();
}
?>