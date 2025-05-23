<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'estudiante') {
    header("Location: login.html");
    exit;
}
$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Estudiante</title>
  <style>
    /* Reset básico */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
      background-color: #f5f8fa;
    }

    body, html {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100%;
      background-color: #f9fafb;
      color: #222;
      display: flex;
    }

    .sidebar {
      width: 220px;
      background-color: #5C9DBF;
      color: white;
      height: 100vh;
      padding: 25px 20px;
      box-sizing: border-box;
      position: fixed;
      top: 0;
      left: 0;
      overflow-y: auto;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar h2 {
      font-size: 1.4rem;
      font-weight: 700;
      margin-bottom: 30px;
      border-bottom: 2px solid rgba(255,255,255,0.4);
      padding-bottom: 10px;
    }

    .sidebar nav a {
      display: block;
      color: rgb(0, 0, 0);
      font-weight: 600;
      text-decoration: none;
      margin-bottom: 15px;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .sidebar nav a:hover {
      background-color: #477f9a;
    }

    .sidebar nav a.logout {
      margin-top: 40px;
      background-color: #bf5c5c;
      font-weight: 700;
    }

    .sidebar nav a.logout:hover {
      background-color: #9a4747;
    }

    .main-content {
      margin-left: 220px;
      padding: 40px 50px;
      flex-grow: 1;
    }

    .main-content h1 {
      font-size: 2.2rem;
      margin-bottom: 20px;
    }

    .main-content p {
      font-size: 1.1rem;
      color: #444;
    }

    @media (max-width: 600px) {
      body {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        box-shadow: none;
      }

      .main-content {
        margin-left: 0;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>Estudiante: <?php echo htmlspecialchars($nombre); ?></h2>
    <nav>
      <a href="../php/ver_notas.php">Ver Notas</a>
      <a href="../php/logout.php" class="logout">Cerrar Sesión</a>
    </nav>
  </div>

  <div class="main-content">
    <h1>Bienvenido Estudiante</h1>
    <p>Usa el menú lateral para navegar.</p>
  </div>
</body>
</html>
