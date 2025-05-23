<?php
require '../php/conexion.php';

$sql = "SELECT id, nombres, apellidos, email, rol, creado_en FROM usuarios WHERE eliminado_en IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios</title>
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

  <h2>Agregar Usuario</h2>
  <form action="../php/agregar_usuario.php" method="POST">
    <label for="nombres">Nombres:</label>
    <input type="text" name="nombres" id="nombres" required>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" id="email" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena" id="contrasena" required>

    <label for="rol">Rol:</label>
    <select name="rol" id="rol" required>
      <option value="">-- Seleccione un rol --</option>
      <option value="docente">Docente</option>
      <option value="estudiante">Estudiante</option>
    </select>

    <button type="submit">Agregar Usuario</button>
  </form>

  <h2>Lista de Usuarios</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Email</th>
      <th>Rol</th>
      <th>Creado en</th>
      <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['nombres']) ?></td>
        <td><?= htmlspecialchars($row['apellidos']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['rol']) ?></td>
        <td><?= $row['creado_en'] ?></td>
        <td class="acciones">
          <a href="form_editar_usuario.php?id=<?= $row['id'] ?>">✏️ Editar</a>
          <a href="../php/eliminar_usuario.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar este usuario?')">🗑️ Eliminar</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</body>
</html>
