<?php
require '../php/conexion.php';

if (!isset($_GET['id'])) {
    echo "ID no especificado.";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM lugares WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Lugar no encontrado.";
    exit;
}

$lugar = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Lugar</title>
</head>
<body>
  <h2>Editar Lugar</h2>
  <form action="../php/actualizar_lugar.php" method="POST">
    <input type="hidden" name="id" value="<?= $lugar['id'] ?>">
    <input type="text" name="nombre_lugar" value="<?= htmlspecialchars($lugar['nombre_lugar']) ?>" required>
    <button type="submit">Guardar Cambios</button>
  </form>
</body>
</html>
