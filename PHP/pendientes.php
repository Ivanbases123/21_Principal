<?php include 'get_solicitudes_pendientes.php'; ?>
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
        <a href="#usuarios">👤👤 Usuarios</a>
        <a href="#historial">🕓 Historial / Auditoría</a>
        <a href="#logout" class="logout-link">↩️ Cerrar sesión</a>
      </nav>
    </aside>

    <div class="main-wrapper">
      <header class="topbar">
        <h1>Solicitudes Pendientes</h1>
      </header>
      <main class="main-content">
        <section class="tabla-pendientes">
          <div class="table-container">
            <table border="1" cellpadding="5">
              <thead>
                <tr>
                  <th>Nombre del cliente</th>
                  <th>Empresa</th>
                  <th>Deseo</th>
                  <th>Servicio solicitado</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                  <th>Detalle</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                  while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                      <td>{$fila['nombre_cliente']}</td>
                      <td>{$fila['empresa']}</td>
                      <td>{$fila['nombre_deseo']}</td>
                      <td>" . ($fila['nombre_servicio'] ?? 'No aplica') . "</td>
                      <td>{$fila['fecha_solicitud']}</td>
                      <td>{$fila['estado']}</td>
                      <td><a href='detalle_solicitud.php?id={$fila['id_solicitud']}' class='btn btn-view'>🔍 Ver solicitud</a></td>
                    </tr>";
                  }
                } else {
                  echo "<tr><td colspan='7'>No hay solicitudes pendientes.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </section>
      </main>
      <?php
      mysqli_close($conexion);
      ?>
    </div>
  </div>
</body>
</html>
