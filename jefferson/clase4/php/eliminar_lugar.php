<?php
require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("UPDATE lugares SET eliminado_en = NOW() WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../vistas/lugares.php");
        exit;
    } else {
        echo "Error al eliminar.";
    }
}
?>
