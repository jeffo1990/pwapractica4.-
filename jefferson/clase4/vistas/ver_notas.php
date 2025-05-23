<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'estudiante') {
    header("Location: login.html");
    exit;
}

require 'conexion.php';

$estudiante_id = $_SESSION['usuario_id'];

$sql = "SELECT 
    a.nombre_asignatura, 
    n.nota_teoria, 
    n.nota_practica, 
    n.creado_en
FROM notas n
JOIN asignacion ag ON n.id_asignacion = ag.id
JOIN asignaturas a ON ag.id_asignatura = a.id
WHERE ag.id_estudiante = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $estudiante_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            color: #5C9DBF;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #5C9DBF;
            color: white;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #5C9DBF;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>Mis Notas</h2>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Asignatura</th>
            <th>Nota Teoría</th>
            <th>Nota Práctica</th>
            <th>Fecha</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nombre_asignatura']) ?></td>
            <td><?= htmlspecialchars($row['nota_teoria']) ?></td>
            <td><?= htmlspecialchars($row['nota_practica']) ?></td>
            <td><?= htmlspecialchars($row['creado_en']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No tienes notas registradas aún.</p>
    <?php endif; ?>

    <a href="../vistas/panel_estudiante.php">← Volver al Panel</a>
</body>
</html>
