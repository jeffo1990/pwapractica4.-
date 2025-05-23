<?php
require 'conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre_asignatura'];
$id_lugar = $_POST['id_lugar'];

$stmt = $conn->prepare("UPDATE asignaturas SET nombre_asignatura = ?, id_lugar = ? WHERE id = ?");
$stmt->bind_param("sii", $nombre, $id_lugar, $id);

if ($stmt->execute()) {
    header("Location: listar_asignaturas.php");
    exit;
} else {
    echo "Error al actualizar: " . $stmt->error;
}
