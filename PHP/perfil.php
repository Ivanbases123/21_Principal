
<?php include 'get_usuario.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Perfil del Administrador</title>
  <link rel="stylesheet" href="../CSS/stylesDashboard.css" />
  <link rel="stylesheet" href="../CSS/stylesPerfil.css" />
</head>
<body class="light">
<div class="dashboard">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <a href="pendientes.php"><img src="../IMG/logoazul.jpg" alt="Logo Empresa" class="logo"></a>
    </div>
    <nav>
      <a href="perfil.php" class="active">🛠️👤 <?php echo htmlspecialchars($nombre); ?></a>
      <a href="pendientes.php">📥 Solicitudes pendientes</a>
      <a href="proceso.php">⏳ Solicitudes en proceso</a>
      <a href="finalizado.php">✅ Solicitudes finalizadas</a>
      <a href="usuarios.php">👤👤 Usuarios</a>
      <a href="historial.php">🕓 Historial / Auditoría</a>
      <a href="../PHP/logout.php" class="logout-link">↩️ Cerrar sesión</a>
    </nav>
  </aside>

  <!-- Main content -->
  <div class="main-wrapper">
    <header class="topbar">
      <h1>Perfil del Administrador</h1>
    </header>

    <main class="main-content">
      <div class="perfil-container">
        <div class="perfil-header">
          <img src="../IMG/avatar.png" alt="Avatar">
          <h2><?php echo htmlspecialchars($nombre); ?></h2>
        </div>

        <div class="perfil-info">
          <!-- Info usuario -->
          <div class="info-box">
            <h3>Información básica</h3>
            <p><strong>Nombre completo:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Correo:</strong> <?php echo htmlspecialchars($correo); ?></p>
            <p><strong>Contraseña:</strong> *********</p>
          </div>

          <!-- Cambiar contraseña -->
          <div class="info-box">
            <h3>Cambiar contraseña</h3>
            <form method="POST" action="cambiar_contrasena.php">
              <label for="nueva_contrasena">Nueva contraseña:</label>
              <input type="password" name="nueva_contrasena" id="nueva_contrasena" required />
              <button type="submit">Actualizar</button>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>

</div>
</body>
</html>
