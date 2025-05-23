<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'docente') {
    header("Location: login.html");
    exit;
}
$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Docente</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
      background-color: #f5f8fa;
    }

    form {
      background: white;
      max-width: 380px;
      margin: 80px auto;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    form h2 {
      margin-bottom: 25px;
      font-weight: 700;
      font-size: 1.8rem;
      color: #2c3e50;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="password"],
    form select {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 1.8px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    form input[type="text"]:focus,
    form input[type="email"]:focus,
    form input[type="password"]:focus,
    form select:focus {
      border-color: #5c9dbf;
      outline: none;
      box-shadow: 0 0 8px rgba(92, 157, 191, 0.4);
    }

    form button {
      width: 100%;
      padding: 14px;
      background-color: #5c9dbf;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 1.1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    form button:hover {
      background-color: #477f9a;
    }

    form p {
      margin-top: 18px;
      font-size: 0.9rem;
      color: #666;
    }

    form a {
      color: #5c9dbf;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }

    form a:hover {
      color: #477f9a;
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
    <h2>Docente: <?php echo htmlspecialchars($nombre); ?></h2>
    <nav>
      <a href="lugares.php">Agregar Lugares</a>
      <a href="form_agregar_asignatura.php">Agregar Asignatura</a>
      <a href="asignacion.php">Agregar Asignacion</a>
      <a href="notas.php">Ingresar Notas</a>
      <a href="usuarios.php">Agregar Usuarios</a>
      <a href="../php/logout.php" class="logout">Cerrar Sesión</a>
    </nav>
  </div>

  <div class="main-content">
    <h1>Bienvenido Docente</h1>
    <p>Selecciona una opción del menú para comenzar.</p>
  </div>
</body>
</html>
