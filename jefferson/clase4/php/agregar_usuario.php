<?php
require '../php/conexion.php';

if (isset($_POST['nombres'], $_POST['apellidos'], $_POST['email'], $_POST['contrasena'], $_POST['rol'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Encriptar contraseña

    // Validar rol
    if (!in_array($rol, ['docente', 'estudiante'])) {
        die("Rol inválido.");
    }

    $sql = "INSERT INTO usuarios (nombres, apellidos, email, contrasena, rol) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $nombres, $apellidos, $email, $contrasena, $rol);

    if ($stmt->execute()) {
        header('Location: ../vistas/usuarios.php');
        exit;
    } else {
        echo "Error al agregar usuario: " . $conn->error;
    }
} else {
    echo "Datos incompletos.";
}
?>
