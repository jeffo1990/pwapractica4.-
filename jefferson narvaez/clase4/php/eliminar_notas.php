<?php
require 'conexion.php';

$id = $_POST['id']; // ID de la nota a eliminar

$sql = "UPDATE notas SET eliminado_en = NOW() WHERE id = ? AND eliminado_en IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "✅ Nota eliminada correctamente (eliminación lógica).";
} else {
    echo "❌ Error al eliminar nota: " . $stmt->error;
}

$conn->close();
?>
