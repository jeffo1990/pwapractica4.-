<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre_lugar']);

    $stmt = $conn->prepare("UPDATE lugares SET nombre_lugar = ? WHERE id = ?");
    $stmt->bind_param("si", $nombre, $id);

    if ($stmt->execute()) {
        header("Location: ../vistas/lugares.php");
        exit;
    } else {
        echo "Error al actualizar.";
    }
}
?>
