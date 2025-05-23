<?php
require '../php/conexion.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "UPDATE notas SET eliminado_en = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header('Location: ../vistas/notas.php');
        exit;
    } else {
        echo "Error al eliminar la nota.";
    }
} else {
    echo "ID no válido.";
}
?>
