<?php
require 'conexion.php';

$sql = "SELECT a.id, a.nombre_asignatura, l.nombre_lugar
        FROM asignaturas a
        LEFT JOIN lugares l ON a.id_lugar = l.id
        WHERE a.eliminado_en IS NULL";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Asignaturas</title>
</head>
<body>
  <h2>Asignaturas</h2>
  <a href="../html/form_agregar_asignatura.php">Agregar nueva asignatura</a><br><br>

  <table border="1">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Lugar</th>
      <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['nombre_asignatura'] ?></td>
      <td><?= $row['nombre_lugar'] ?></td>
      <td>
        <a href="../html/form_editar_asignatura.php?id=<?= $row['id'] ?>">Editar</a> |
        <a href="eliminar_asignatura.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar asignatura?')">Eliminar</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
