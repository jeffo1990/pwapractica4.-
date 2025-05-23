
<?php
$host = "localhost";
$user = "root";
$password = "";  // cambia si tu base tiene contraseña
$db = "calificaciones";  // o el nombre de tu base de datos

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
