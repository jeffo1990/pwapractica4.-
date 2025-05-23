<?php
require 'conexion.php';

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

$stmt = $conn->prepare("INSERT INTO usuarios (nombres, apellidos, email, contrasena, rol) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombres, $apellidos, $email, $contrasena, $rol);

if ($stmt->execute()) {
    echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href = '../vistas/login.html';</script>";
} else {
    echo "Error al registrar: " . $stmt->error;
}
?>
