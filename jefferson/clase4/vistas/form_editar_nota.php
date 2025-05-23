<?php
require '../php/conexion.php';

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM notas WHERE id = ? AND eliminado_en IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$nota = $result->fetch_assoc();

if (!$nota) {
    die("Nota no encontrada.");
}

// Obtener asignaciones activas
$asignaciones = $conn->query("SELECT asig.id, CONCAT(u.nombres, ' ', u.apellidos, ' - ', a.nombre_asignatura) AS descripcion
                             FROM asignacion asig
                             JOIN usuarios u ON asig.id_estudiante = u.id
                             JOIN asignaturas a ON asig.id_asignatura = a.id
                             WHERE asig.eliminado_en IS NULL");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Nota</title>
</head>
<body>

<h2>Editar Nota</h2>
<form action="../php/editar_nota.php" method="POST">
  <input type="hidden" name="id" value="<?= $nota['id'] ?>">

  <label for="id_asignacion">Asignación:</label>
  <select name="id_asignacion" id="id_asignacion" required>
    <option value="">-- Seleccione una asignación --</option>
    <?php while ($asig = $asignaciones->fetch_assoc()): ?>
      <option value="<?= $asig['id'] ?>" <?= $asig['id'] == $nota['id_asignacion'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($asig['descripcion']) ?>
      </option>
    <?php endwhile; ?>
  </select>

  <label for="nota_teoria">Nota Teoría:</label>
  <input type="number" step="0.01" min="0" max="100" name="nota_teoria" id="nota_teoria" value="<?= $nota['nota_teoria'] ?>" required>

  <label for="nota_practica">Nota Práctica:</label>
  <input type="number" step="0.01" min="0" max="100" name="nota_practica" id="nota_practica" value="<?= $nota['nota_practica'] ?>" required>

  <button type="submit">Guardar Cambios</button>
</form>

</body>
</html>
