<?php
require '../php/conexion.php';

if (isset($_POST['id_asignacion'], $_POST['nota_teoria'], $_POST['nota_practica'])) {
    $id_asignacion = (int)$_POST['id_asignacion'];
    $nota_teoria = (float)$_POST['nota_teoria'];
    $nota_practica = (float)$_POST['nota_practica'];

    $sql = "INSERT INTO notas (id_asignacion, nota_teoria, nota_practica) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('idd', $id_asignacion, $nota_teoria, $nota_practica);

    if ($stmt->execute()) {
        header('Location: ../vistas/notas.php');
        exit;
    } else {
        echo "Error al agregar la nota.";
    }
} else {
    echo "Datos incompletos.";
}
?>
