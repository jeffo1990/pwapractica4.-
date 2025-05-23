<?php
require '../php/conexion.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM asignaturas WHERE id = ? AND eliminado_en IS NULL");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$asignatura = $result->fetch_assoc();

$lugares = $conn->query("SELECT id, nombre_lugar FROM lugares");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Asignatura</title>
</head>
<body>
  <h2>Editar Asignatura</h2>
  <form action="../php/editar_asignatura.php" method="POST">
    <input type="hidden" name="id" value="<?= $asignatura['id'] ?>">
    <label>Nombre:</label><br>
    <input type="text" name="nombre_asignatura" value="<?= htmlspecialchars($asignatura['nombre_asignatura']) ?>" required><br>
    
    <label>Lugar:</label><br>
    <select name="id_lugar" required>
      <option value="">Seleccione un lugar</option>
      <?php while ($lugar = $lugares->fetch_assoc()): ?>
        <option value="<?= $lugar['id'] ?>" <?= $lugar['id'] == $asignatura['id_lugar'] ? 'selected' : '' ?>>
          <?= $lugar['nombre_lugar'] ?>
        </option>
      <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Guardar cambios</button>
  </form>
  <a href="../php/listar_asignaturas.php">Volver</a>
</body>
</html>
