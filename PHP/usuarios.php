<?php include 'get_usuarios.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../CSS/stylesDashboard.css" />
  <title>Solicitudes Pendientes</title>
</head>
<body class="light">
  <div class="dashboard">
    <aside class="sidebar">
      <div class="sidebar-logo">
        <img src="../IMG/logoazul.jpg" alt="Logo Empresa" class="logo">
      </div>
      <nav>
        <a href="#user">🛠️👤 Nombre Usuario</a>
        <a href="pendientes.php" class="active">📥 Solicitudes pendientes</a>
        <a href="proceso.php">⏳ Solicitudes en proceso</a>
        <a href="finalizado.php">✅ Solicitudes finalizadas</a>
        <a href="usuarios.php">👤👤 Usuarios</a>
        <a href="historial.php">🕓 Historial / Auditoría</a>
        <a href="../PHP/logout.php" class="logout-link">↩️ Cerrar sesión</a>
      </nav>
    </aside>

    <div class="main-wrapper">
      <header class="topbar">
        <h1>Usuarios Registrados</h1>
      </header>
      <main class="main-content">
        <a href="nuevo_usuario.php" class="btn btn-add">➕ Nuevo Usuario</a>
        <table border="1" cellpadding="5">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Departamento</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($resultado && mysqli_num_rows($resultado) > 0) {
              while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>
                        <td>{$fila['nombre_usuario']}</td>
                        <td>{$fila['email']}</td>
                        <td>{$fila['rol']}</td>
                        <td>" . ($fila['nombre_departamento'] ?? 'Sin asignar') . "</td>
                        <td>
                          <a href='editar_usuario.php?id={$fila['id_usuario']}'>✏️ Editar</a> |
                          <a href='eliminar_usuario.php?id={$fila['id_usuario']}' onclick=\"return confirm('¿Seguro que quieres eliminar este usuario?');\">❌ Eliminar</a>
                        </td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='5'>No hay usuarios registrados.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </main>
      <?php mysqli_close($conexion); ?>
    </div>
  </div>
</body>
</html>
