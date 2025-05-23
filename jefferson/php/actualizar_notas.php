<?php
require 'conexion.php';

$id = $_POST['id']; // ID de la nota que se va a actualizar
$nota_teoria = $_POST['nueva_nota_teoria'];
$nota_practica = $_POST['nueva_nota_practica'];

$sql = "UPDATE notas SET nota_teoria = ?, nota_practica = ?, actualizado_en = NOW()
        WHERE id = ? AND eliminado_en IS NULL";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ddi", $nota_teoria, $nota_practica, $id);

if ($stmt->execute()) {
    echo "✅ Nota actualizada correctamente.";
} else {
    echo "❌ Error al actualizar nota: " . $stmt->error;
}

$conn->close();
?>
