<?php
require 'conexion.php';

$id = $_GET['id'];

$stmt = $conn->prepare("UPDATE asignaturas SET eliminado_en = NOW() WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: listar_asignaturas.php");
    exit;
} else {
    echo "Error al eliminar asignatura: " . $stmt->error;
}
