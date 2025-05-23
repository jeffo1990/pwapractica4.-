<?php
require '../php/conexion.php';

// Consulta para asignaciones (mostrar tabla)
$sql = "SELECT 
          asig.id, 
          CONCAT(u.nombres, ' ', u.apellidos) AS nombre_estudiante, 
          a.nombre_asignatura, 
          asig.creado_en
        FROM asignacion asig
        JOIN usuarios u ON asig.id_estudiante = u.id
        JOIN asignaturas a ON asig.id_asignatura = a.id
        WHERE asig.eliminado_en IS NULL";

$result = $conn->query($sql);

// Consulta para estudiantes (solo rol estudiante y sin eliminar)
$estudiantes = $conn->query("SELECT id, CONCAT(nombres, ' ', apellidos) AS nombre FROM usuarios WHERE rol = 'estudiante' AND eliminado_en IS NULL");

// Consulta para asignaturas no eliminadas
$asignaturas = $conn->query("SELECT id, nombre_asignatura FROM asignaturas WHERE eliminado_en IS NULL");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Asignaciones</title>
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

  <h2>Agregar Asignación</h2>
  <form action="../php/agregar_asignacion.php" method="POST">
    <label for="id_estudiante">Estudiante:</label>
    <select name="id_estudiante" id="id_estudiante" required>
      <option value="">-- Seleccione un estudiante --</option>
      <?php while ($est = $estudiantes->fetch_assoc()): ?>
        <option value="<?= $est['id'] ?>"><?= htmlspecialchars($est['nombre']) ?></option>
      <?php endwhile; ?>
    </select>

    <label for="id_asignatura">Asignatura:</label>
    <select name="id_asignatura" id="id_asignatura" required>
      <option value="">-- Seleccione una asignatura --</option>
      <?php while ($asig = $asignaturas->fetch_assoc()): ?>
        <option value="<?= $asig['id'] ?>"><?= htmlspecialchars($asig['nombre_asignatura']) ?></option>
      <?php endwhile; ?>
    </select>

    <button type="submit">Agregar Asignación</button>
  </form>

  <h2>Lista de Asignaciones</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Estudiante</th>
      <th>Asignatura</th>
      <th>Creado en</th>
      <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nombre_estudiante']) ?></td>
        <td><?= htmlspecialchars($row['nombre_asignatura']) ?></td>
        <td><?= $row['creado_en'] ?></td>
        <td class="acciones">
          <a href="form_editar_asignacion.php?id=<?= $row['id'] ?>">✏️ Editar</a>
          <a href="../php/eliminar_asignacion.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar esta asignación?')">🗑️ Eliminar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</body>
</html>
