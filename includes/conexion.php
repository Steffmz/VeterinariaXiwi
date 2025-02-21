<?php
$servername = "localhost";
// Usuario de MySQL (no el email de tu aplicación)
$username = "root"; // <-- Usuario por defecto en XAMPP/WAMP
$password = ""; // <-- Contraseña por defecto (usualmente vacía)
$dbname = "VeterinariaXiwi"; // Nombre exacto de tu BD (case-sensitive)

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>