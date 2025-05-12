<?php include 'get_editar_usuario.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="../CSS/stylesDashboard.css">
</head>
<body class="light">
  <div class="dashboard">
    <aside class="sidebar">
      <div class="sidebar-logo">
        <img src="../IMG/logoazul.jpg" alt="Logo Empresa" class="logo">
      </div>
      <nav>
        <a href="pendientes.php">📥 Pendientes</a>
        <a href="proceso.php">⏳ En proceso</a>
        <a href="finalizado.php">✅ Finalizadas</a>
        <a href="usuarios.php" class="active">👤👤 Usuarios</a>
        <a href="historial.php">🕓 Historial</a>
        <a href="../PHP/logout.php" class="logout-link">↩️ Cerrar sesión</a>
      </nav>
    </aside>

    <div class="main-wrapper">
      <header class="topbar">
        <h1>Editar Usuario</h1>
      </header>
      <main class="main-content">
        <form method="POST" action="procesar_editar_usuario.php">
          <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

          <label for="nombre_usuario">Nombre:</label>
          <input type="text" name="nombre_usuario" id="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>" required>

          <label for="email">Email:</label>
          <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

          <label for="password">Nueva contraseña (opcional):</label>
          <input type="password" name="password" id="password" placeholder="Dejar en blanco para no cambiarla">

          <label for="rol">Rol:</label>
          <select name="rol" id="rol" required>
            <option value="Administrador" <?php if ($usuario['rol'] === 'Administrador') echo 'selected'; ?>>Administrador</option>
            <option value="Departamento" <?php if ($usuario['rol'] === 'Departamento') echo 'selected'; ?>>Departamento</option>
          </select>

          <label for="id_departamento">Departamento:</label>
          <select name="id_departamento" id="id_departamento">
            <option value="">-- Sin asignar --</option>
            <?php while ($dept = mysqli_fetch_assoc($resultado_deptos)): ?>
              <option value="<?php echo $dept['id_departamento']; ?>"
                <?php if ($usuario['id_departamento'] == $dept['id_departamento']) echo 'selected'; ?>>
                <?php echo $dept['nombre_departamento']; ?>
              </option>
            <?php endwhile; ?>
          </select>

          <button type="submit" class="btn btn-add">Guardar Cambios</button>
        </form>
      </main>
      <?php mysqli_close($conexion); ?>
    </div>
  </div>
</body>
</html>
