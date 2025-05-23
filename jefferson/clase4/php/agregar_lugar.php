<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre_lugar']);

    $stmt = $conn->prepare("INSERT INTO lugares (nombre_lugar) VALUES (?)");
    $stmt->bind_param("s", $nombre);

    if ($stmt->execute()) {
        header("Location: ../vistas/lugares.php"); // Ajusta la ruta según tu estructura
        exit;
    } else {
        echo "Error al guardar el lugar.";
    }
}
?>
