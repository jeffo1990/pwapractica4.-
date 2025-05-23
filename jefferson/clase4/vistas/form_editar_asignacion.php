<?php
require '../php/conexion.php';

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = (int)$_GET['id'];

// Obtener datos actuales de la asignación
$sql = "SELECT * FROM asignacion WHERE id = ? AND eliminado_en IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$asignacion = $result->fetch_assoc();

if (!$asignacion) {
    die("Asignación no encontrada.");
}

// Obtener estudiantes
$estudiantes = $conn->query("SELECT id, CONCAT(nombres, ' ', apellidos) AS nombre FROM usuarios WHERE rol = 'estudiante' AND eliminado_en IS NULL");

// Obtener asignaturas
$asignaturas = $conn->query("SELECT id, nombre_asignatura FROM asignaturas WHERE eliminado_en IS NULL");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Asignación</title>
</head>
<body>

<h2>Editar Asignación</h2>
<form action="../php/editar_asignacion.php" method="POST">
  <input type="hidden" name="id" value="<?= $asignacion['id'] ?>">

  <label for="id_estudiante">Estudiante:</label>
  <select name="id_estudiante" id="id_estudiante" required>
    <option value="">-- Seleccione un estudiante --</option>
    <?php while ($est = $estudiantes->fetch_assoc()): ?>
      <option value="<?= $est['id'] ?>" <?= $est['id'] == $asignacion['id_estudiante'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($est['nombre']) ?>
      </option>
    <?php endwhile; ?>
  </select>

  <label for="id_asignatura">Asignatura:</label>
  <select name="id_asignatura" id="id_asignatura" required>
    <option value="">-- Seleccione una asignatura --</option>
    <?php while ($asig = $asignaturas->fetch_assoc()): ?>
      <option value="<?= $asig['id'] ?>" <?= $asig['id'] == $asignacion['id_asignatura'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($asig['nombre_asignatura']) ?>
      </option>
    <?php endwhile; ?>
  </select>

  <button type="submit">Guardar Cambios</button>
</form>

</body>
</html>
