<?php
require 'conexion.php';

$nombre_asignatura = $_POST['nombre_asignatura'] ?? null;
$id_lugar = $_POST['id_lugar'] ?? null;

if ($nombre_asignatura && $id_lugar) {
    $stmt = $conn->prepare("INSERT INTO asignaturas (nombre_asignatura, id_lugar) VALUES (?, ?)");
    $stmt->bind_param("si", $nombre_asignatura, $id_lugar);

    if ($stmt->execute()) {
        echo "Asignatura agregada correctamente.";
    } else {
        echo "Error al agregar la asignatura: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Faltan datos para agregar la asignatura.";
}
