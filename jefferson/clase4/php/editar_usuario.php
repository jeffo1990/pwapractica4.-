<?php
require '../php/conexion.php';

if (isset($_POST['id'], $_POST['nombres'], $_POST['apellidos'], $_POST['email'], $_POST['rol'])) {
    $id = (int)$_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    if (!in_array($rol, ['docente', 'estudiante'])) {
        die("Rol inválido.");
    }

    if (!empty($_POST['contrasena'])) {
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nombres=?, apellidos=?, email=?, rol=?, contrasena=?, actualizado_en=NOW() WHERE id=? AND eliminado_en IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $nombres, $apellidos, $email, $rol, $contrasena, $id);
    } else {
        $sql = "UPDATE usuarios SET nombres=?, apellidos=?, email=?, rol=?, actualizado_en=NOW() WHERE id=? AND eliminado_en IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $nombres, $apellidos, $email, $rol, $id);
    }

    if ($stmt->execute()) {
        header('Location: ../vistas/usuarios.php');
        exit;
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }
} else {
    echo "Datos incompletos.";
}
?>
