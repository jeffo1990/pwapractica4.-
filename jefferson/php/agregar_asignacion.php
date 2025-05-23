<?php
require 'conexion.php';

$id_estudiante = $_POST['id_estudiante'] ?? null;
$id_asignatura = $_POST['id_asignatura'] ?? null;

if ($id_estudiante && $id_asignatura) {
    $stmt = $conn->prepare("INSERT INTO asignacion (id_estudiante, id_asignatura) VALUES (?, ?)");
    $stmt->bind_param("ii", $id_estudiante, $id_asignatura);
    $stmt->execute();
}

header("Location: ../vistas/asignacion.php");
exit;
