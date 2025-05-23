<?php
require '../php/conexion.php';

if (isset($_POST['id'], $_POST['id_estudiante'], $_POST['id_asignatura'])) {
    $id = (int)$_POST['id'];
    $id_estudiante = (int)$_POST['id_estudiante'];
    $id_asignatura = (int)$_POST['id_asignatura'];

    $sql = "UPDATE asignacion SET id_estudiante = ?, id_asignatura = ? WHERE id = ? AND eliminado_en IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $id_estudiante, $id_asignatura, $id);

    if ($stmt->execute()) {
        header('Location: ../vistas/asignacion.php');
        exit;
    } else {
        echo "Error al actualizar la asignación.";
    }
} else {
    echo "Datos incompletos.";
}
?>
