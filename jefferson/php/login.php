<?php
require 'conexion.php';
session_start();

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND eliminado_en IS NULL");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    if (password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['nombre'] = $usuario['nombres'];

        if ($usuario['rol'] === 'docente') {
            header("Location: ../vistas/panel_docente.php");
        } else {
            header("Location: ../vistas/panel_estudiante.php");
        }
        exit;
    } else {
        echo "<script>alert('Contraseña incorrecta'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Usuario no encontrado'); window.history.back();</script>";
}
?>
