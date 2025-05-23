<?php
require '../php/conexion.php';

// Consulta para obtener asignaturas
$sql = "SELECT a.id, a.nombre_asignatura, l.nombre_lugar 
        FROM asignaturas a 
        LEFT JOIN lugares l ON a.id_lugar = l.id
        WHERE a.eliminado_en IS NULL";
$result = $conn->query($sql);

// Obtener lugares para el selector
$lugares = $conn->query("SELECT id, nombre_lugar FROM lugares WHERE eliminado_en IS NULL");
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Asignaturas</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }
    th {
      background-color: #5C9DBF;
      color: white;
    }
    .acciones a {
      margin: 0 5px;
      text-decoration: none;
      color: blue;
    }
  </style>
</head>
<body>
  <h2>Agregar Asignatura</h2>
  <form action="../php/agregar_asignatura.php" method="POST">
    <input type="text" name="nombre_asignatura" placeholder="Nombre de la asignatura" required>
    <select name="id_lugar" required>
      <option value="">Seleccione un lugar</option>
      <?php while ($lugar = $lugares->fetch_assoc()): ?>
        <option value="<?= $lugar['id'] ?>"><?= htmlspecialchars($lugar['nombre_lugar']) ?></option>
      <?php endwhile; ?>
    </select>
    <button type="submit">Agregar Asignatura</button>
  </form>

  <h2>Lista de Asignaturas</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre Asignatura</th>
      <th>Lugar</th>
      <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['nombre_asignatura']) ?></td>
      <td><?= htmlspecialchars($row['nombre_lugar'] ?? 'Sin lugar') ?></td>
      <td class="acciones">
        <a href="form_editar_asignatura.php?id=<?= $row['id'] ?>">✏️ Editar</a>
        <a href="../php/eliminar_asignatura.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar esta asignatura?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
