<?php
require '../php/conexion.php';

// Obtener asignaturas para el selector
$sql = "SELECT id, nombre_asignatura FROM asignaturas WHERE eliminado_en IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ingresar Notas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h2 {
      color: #5C9DBF;
    }
    form {
      max-width: 400px;
    }
    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 8px 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 16px;
    }
    button {
      background-color: #5C9DBF;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 4px;
      font-size: 16px;
    }
    button:hover {
      background-color: #497aa0;
    }
    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }
  </style>
</head>
<body>
  <h2>Formulario para Ingresar Notas</h2>
  <form action="../php/ingresar_notas.php" method="POST">
    <input type="text" name="email_estudiante" placeholder="Email del Estudiante" required>

    <label for="id_asignacion">Asignatura:</label>
    <select name="id_asignacion" id="id_asignacion" required>
      <option value="">-- Seleccione una asignatura --</option>
      <?php while ($asig = $result->fetch_assoc()): ?>
        <option value="<?= $asig['id'] ?>"><?= htmlspecialchars($asig['nombre_asignatura']) ?></option>
      <?php endwhile; ?>
    </select>

    <input type="number" name="nota_teoria" placeholder="Nota Teoría" step="0.01" min="0" max="20" required>
    <input type="number" name="nota_practica" placeholder="Nota Práctica" step="0.01" min="0" max="20" required>

    <button type="submit">Guardar</button>
  </form>
</body>
</html>
