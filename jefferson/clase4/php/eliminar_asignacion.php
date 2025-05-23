<?php
require '../php/conexion.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Actualizamos eliminado_en para soft delete
    $sql = "UPDATE asignacion SET eliminado_en = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header('Location: ../vistas/asignacion.php');
        exit;
    } else {
        echo "Error al eliminar la asignación.";
    }
} else {
    echo "ID no válido.";
}
?>
