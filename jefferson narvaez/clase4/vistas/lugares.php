<?php
require '../php/conexion.php'; // Ajusta la ruta si es necesario

// Obtener lugares no eliminados
$sql = "SELECT * FROM lugares WHERE eliminado_en IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Lugares</title>
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
  <h2>Agregar Lugar</h2>
  <form action="../php/agregar_lugar.php" method="POST">
    <input type="text" name="nombre_lugar" placeholder="Nombre del lugar" required>
    <button type="submit">Agregar Lugar</button>
  </form>

  <h2>Lista de Lugares</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombre Lugar</th>
      <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['nombre_lugar']) ?></td>
      <td class="acciones">
        <a href="form_editar_lugar.php?id=<?= $row['id'] ?>">✏️ Editar</a>
        <a href="../php/eliminar_lugar.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este lugar?')">🗑️ Eliminar</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
