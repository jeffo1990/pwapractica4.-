<?php
require '../php/conexion.php';

// Consultar notas que no están eliminadas, con info de estudiante y asignatura
$sql = "SELECT n.id, 
               CONCAT(u.nombres, ' ', u.apellidos) AS nombre_estudiante, 
               a.nombre_asignatura, 
               n.nota_teoria, 
               n.nota_practica, 
               n.creado_en
        FROM notas n
        JOIN asignacion asig ON n.id_asignacion = asig.id
        JOIN usuarios u ON asig.id_estudiante = u.id
        JOIN asignaturas a ON asig.id_asignatura = a.id
        WHERE n.eliminado_en IS NULL";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Notas</title>
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
      font-weight: bold;
    }
    form {
      max-width: 450px;
      margin-bottom: 30px;
    }
    input, select, button {
      padding: 8px;
      margin: 6px 0;
      width: 100%;
      box-sizing: border-box;
      font-size: 16px;
    }
    button {
      background-color: #5C9DBF;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 4px;
    }
    button:hover {
      background-color: #497aa0;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 12px;
    }
  </style>
</head>
<body>

  <h2>Agregar Nota</h2>
  <form action="../php/agregar_nota.php" method="POST">
    <label for="id_asignacion">Asignación:</label>
    <select name="id_asignacion" id="id_asignacion" required>
      <option value="">-- Seleccione una asignación --</option>
      <?php
      // Obtener asignaciones activas para el select
      $asignaciones = $conn->query("SELECT asig.id, CONCAT(u.nombres, ' ', u.apellidos, ' - ', a.nombre_asignatura) AS descripcion
                                   FROM asignacion asig
                                   JOIN usuarios u ON asig.id_estudiante = u.id
                                   JOIN asignaturas a ON asig.id_asignatura = a.id
                                   WHERE asig.eliminado_en IS NULL");
      while ($asig = $asignaciones->fetch_assoc()):
      ?>
        <option value="<?= $asig['id'] ?>"><?= htmlspecialchars($asig['descripcion']) ?></option>
      <?php endwhile; ?>
    </select>

    <label for="nota_teoria">Nota Teoría:</label>
    <input type="number" step="0.01" min="0" max="100" name="nota_teoria" id="nota_teoria" required>

    <label for="nota_practica">Nota Práctica:</label>
    <input type="number" step="0.01" min="0" max="100" name="nota_practica" id="nota_practica" required>

    <button type="submit">Agregar Nota</button>
  </form>

  <h2>Lista de Notas</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Estudiante</th>
      <th>Asignatura</th>
      <th>Nota Teoría</th>
      <th>Nota Práctica</th>
      <th>Creado en</th>
      <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nombre_estudiante']) ?></td>
        <td><?= htmlspecialchars($row['nombre_asignatura']) ?></td>
        <td><?= $row['nota_teoria'] ?></td>
        <td><?= $row['nota_practica'] ?></td>
        <td><?= $row['creado_en'] ?></td>
        <td class="acciones">
          <a href="form_editar_nota.php?id=<?= $row['id'] ?>">✏️ Editar</a>
          <a href="../php/eliminar_nota.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar esta nota?')">🗑️ Eliminar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</body>
</html>
