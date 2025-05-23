<?php
require '../php/conexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "UPDATE usuarios SET eliminado_en = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            // Redirige después de eliminar lógicamente
            header('Location: ../vistas/usuarios.php');
            exit;
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
} else {
    echo "ID no válido.";
}

$conn->close();
?>
