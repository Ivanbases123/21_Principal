<?php
// Activar errores (solo en desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../PHP/conexion_s21sec.php';

session_start();

// Obtener departamentos para el <select>
$query_deptos = "SELECT id_departamento, nombre_departamento FROM Departamentos";
$resultado_deptos = mysqli_query($conexion, $query_deptos);

// Captura de mensaje de error (si vuelve desde el backend con error)
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../CSS/stylesDashboard.css" />
  <title>Nuevo Usuario</title>
</head>
<body class="light">
  <div class="dashboard">
    <aside class="sidebar">
      <div class="sidebar-logo">
      <a href="pendientes.php"><img src="../IMG/logoazul.jpg" alt="Logo Empresa" class="logo"></a>
      </div>
      <nav>
        <a href="pendientes.php">📥 Pendientes</a>
        <a href="proceso.php">⏳ En proceso</a>
        <a href="finalizado.php">✅ Finalizadas</a>
        <a href="usuarios.php" class="active">👤👤 Usuarios</a>
        <a href="historial.php">🕓 Historial / Auditoría</a>
        <a href="../PHP/logout.php" class="logout-link">↩️ Cerrar sesión</a>
      </nav>
    </aside>

    <div class="main-wrapper">
      <header class="topbar">
        <h1>Registrar Nuevo Usuario</h1>
      </header>
      <main class="main-content">
        <?php if (!empty($error)): ?>
          <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="procesar_nuevo_usuario.php" class="formulario-usuario">
          <label for="nombre_usuario">Nombre:</label>
          <input type="text" name="nombre_usuario" id="nombre_usuario" required>

          <label for="email">Email:</label>
          <input type="email" name="email" id="email" required>

          <label for="password">Contraseña:</label>
          <input type="password" name="password" id="password" required>

          <label for="rol">Rol:</label>
          <select name="rol" id="rol" required>
            <option value="Administrador">Administrador</option>
            <option value="Departamento">Departamento</option>
          </select>

          <label for="id_departamento">Departamento:</label>
          <select name="id_departamento" id="id_departamento">
            <option value="">-- Seleccionar --</option>
            <?php while ($row = mysqli_fetch_assoc($resultado_deptos)): ?>
              <option value="<?php echo $row['id_departamento']; ?>">
                <?php echo $row['nombre_departamento']; ?>
              </option>
            <?php endwhile; ?>
          </select>

          <button type="submit" class="btn btn-add">Guardar Usuario</button>
        </form>
      </main>
      <?php mysqli_close($conexion); ?>
    </div>
  </div>
</body>
</html>
