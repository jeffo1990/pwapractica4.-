<?php
require 'conexion.php';

$email = $_POST['email_estudiante'] ?? null;
$asignatura = $_POST['asignatura'] ?? null;
$nota_teoria = $_POST['nota_teoria'] ?? null;
$nota_practica = $_POST['nota_practica'] ?? null;

if ($email && $asignatura && $nota_teoria && $nota_practica) {
    // 1. Buscar el id del estudiante
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND rol = 'estudiante'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $estudiante = $res->fetch_assoc();
    $stmt->close();

    if (!$estudiante) {
        die("Estudiante no encontrado.");
    }

    $id_estudiante = $estudiante['id'];

    // 2. Buscar el id de la asignatura
    $stmt = $conn->prepare("SELECT id FROM asignaturas WHERE nombre_asignatura = ?");

    $stmt->bind_param("s", $asignatura);
    $stmt->execute();
    $res = $stmt->get_result();
    $asig = $res->fetch_assoc();
    $stmt->close();

    if (!$asig) {
        die("Asignatura no encontrada.");
    }

    $id_asignatura = $asig['id'];

    // 3. Buscar el id de asignación
    $stmt = $conn->prepare("SELECT id FROM asignacion WHERE id_estudiante = ? AND id_asignatura = ?");
    $stmt->bind_param("ii", $id_estudiante, $id_asignatura);
    $stmt->execute();
    $res = $stmt->get_result();
    $asignacion = $res->fetch_assoc();
    $stmt->close();

    if (!$asignacion) {
        die("No se encontró la asignación.");
    }

    $id_asignacion = $asignacion['id'];

    // 4. Insertar la nota
    $stmt = $conn->prepare("INSERT INTO notas (id_asignacion, nota_teoria, nota_practica) VALUES (?, ?, ?)");
    $stmt->bind_param("idd", $id_asignacion, $nota_teoria, $nota_practica);

    if ($stmt->execute()) {
        echo "Nota guardada correctamente.";
    } else {
        echo "Error al guardar la nota: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Faltan datos para ingresar la nota.";
}
