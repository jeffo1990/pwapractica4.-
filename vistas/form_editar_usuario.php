<?php
require '../php/conexion.php';

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = (int)$_GET['id'];

$sql = "SELECT id, nombres, apellidos, email, rol FROM usuarios WHERE id = ? AND eliminado_en IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    die("Usuario no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario</title>
</head>
<body>

<h2>Editar Usuario</h2>
<form action="../php/editar_usuario.php" method="POST">
  <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

  <label for="nombres">Nombres:</label>
  <input type="text" name="nombres" id="nombres" value="<?= htmlspecialchars($usuario['nombres']) ?>" required>

  <label for="apellidos">Apellidos:</label>
  <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>" required>

  <label for="email">Correo electrónico:</label>
  <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

  <label for="rol">Rol:</label>
  <select name="rol" id="rol" required>
    <option value="docente" <?= $usuario['rol'] === 'docente' ? 'selected' : '' ?>>Docente</option>
    <option value="estudiante" <?= $usuario['rol'] === 'estudiante' ? 'selected' : '' ?>>Estudiante</option>
  </select>

  <label for="contrasena">Contraseña: (dejar vacío para no cambiar)</label>
  <input type="password" name="contrasena" id="contrasena" placeholder="Nueva contraseña">

  <button type="submit">Guardar Cambios</button>
</form>

</body>
</html>
