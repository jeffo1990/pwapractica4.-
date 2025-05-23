<?php
require '../php/conexion.php';

if (isset($_POST['id'], $_POST['id_asignacion'], $_POST['nota_teoria'], $_POST['nota_practica'])) {
    $id = (int)$_POST['id'];
    $id_asignacion = (int)$_POST['id_asignacion'];
    $nota_teoria = (float)$_POST['nota_teoria'];
    $nota_practica = (float)$_POST['nota_practica'];

    $sql = "UPDATE notas SET id_asignacion = ?, nota_teoria = ?, nota_practica = ? WHERE id = ? AND eliminado_en IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iddi', $id_asignacion, $nota_teoria, $nota_practica, $id);

    if ($stmt->execute()) {
        header('Location: ../vistas/notas.php');
        exit;
    } else {
        echo "Error al actualizar la nota.";
    }
} else {
    echo "Datos incompletos.";
}
?>
