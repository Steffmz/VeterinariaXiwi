<?php
session_start();
require_once '../../includes/funciones.php';

proteger_ruta();

if (!es_usuario()) {
    header("Location: ../admin/dashboard.php");
    exit();
}
?>