<?php
// ver_notas_simple.php

$conexion = new mysqli("localhost", "root", "", "calificaciones");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Variable para mensajes
$mensaje = "";
$notas = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre o id que envió el estudiante
    $entrada = trim($_POST['entrada']);

    if ($entrada === '') {
        $mensaje = "Por favor, ingresa tu ID o nombre.";
    } else {
        // Verificar si es número (ID) o texto (nombre)
        if (is_numeric($entrada)) {
            // Buscar por ID
            $sql = "
                SELECT 
                    n.id, u.nombres, u.apellidos, a.nombre_asignatura, l.nombre_lugar, 
                    n.nota_teoria, n.nota_practica
                FROM notas n
                JOIN asignacion asg ON n.id_asignacion = asg.id
                JOIN usuarios u ON asg.id_estudiante = u.id
                JOIN asignaturas a ON asg.id_asignatura = a.id
                JOIN lugares l ON a.id_lugar = l.id
                WHERE u.id = ?
            ";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $entrada);
        } else {
            // Buscar por nombre (se puede mejorar para buscar también apellidos)
            $sql = "
                SELECT 
                    n.id, u.nombres, u.apellidos, a.nombre_asignatura, l.nombre_lugar, 
                    n.nota_teoria, n.nota_practica
                FROM notas n
                JOIN asignacion asg ON n.id_asignacion = asg.id
                JOIN usuarios u ON asg.id_estudiante = u.id
                JOIN asignaturas a ON asg.id_asignatura = a.id
                JOIN lugares l ON a.id_lugar = l.id
                WHERE u.nombres LIKE ?
            ";
            $like_nombre = "%$entrada%";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $like_nombre);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $notas[] = $fila;
            }
        } else {
            $mensaje = "No se encontraron notas para el estudiante ingresado.";
        }
        $stmt->close();
    }
}
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Notas</title>
</head>
<body>
    <h2>Consulta de Notas</h2>
    <form method="POST" action="">
        <label for="entrada">Ingresa tu ID o nombre:</label>
        <input type="text" id="entrada" name="entrada" required>
        <button type="submit">Ver Notas</button>
    </form>

    <?php if ($mensaje): ?>
        <p style="color:red;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <?php if (!empty($notas)): ?>
        <h3>Notas encontradas:</h3>
        <?php foreach ($notas as $nota): ?>
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <strong>Estudiante:</strong> <?= htmlspecialchars($nota['nombres'] . " " . $nota['apellidos']) ?><br>
                <strong>Asignatura:</strong> <?= htmlspecialchars($nota['nombre_asignatura']) ?><br>
                <strong>Lugar:</strong> <?= htmlspecialchars($nota['nombre_lugar']) ?><br>
                <strong>Nota Teoría:</strong> <?= htmlspecialchars($nota['nota_teoria']) ?><br>
                <strong>Nota Práctica:</strong> <?= htmlspecialchars($nota['nota_practica']) ?><br>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
