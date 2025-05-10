
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../CSS/stylesDashboard.css" />
  <title>Solicitudes Finalizadas</title>
</head>
<body class="light">
  <div class="dashboard">
    <aside class="sidebar">
      <div class="sidebar-logo">
        <img src="../IMG/logoazul.jpg" alt="Logo Empresa" class="logo">
      </div>
      <nav>
        <a href="#user">🛠️👤 Nombre Usuario</a>
        <a href="../PHP/pendientes.php" class="active">📥 Solicitudes pendientes</a>
        <a href="../PHP/proceso.php">⏳ Solicitudes en proceso</a>
        <a href="../PHP/finalizado.php">✅ Solicitudes finalizadas</a>
        <a href="#usuarios">👤👤 Usuarios</a>
        <a href="#historial">🕓 Historial / Auditoría</a>
        <a href="#logout" class="logout-link">↩️ Cerrar sesión</a>
      </nav>
    </aside>

    <div class="main-wrapper">
      <header class="topbar">
        <h1>Solicitudes Finalizadas</h1>
      </header>
      <main class="main-content">
        <section class="tabla-pendientes">
          <div class="table-container">
            <table>
              <thead>
              <thead>
                <tr>
                  <th>Nombre del cliente</th>
                  <th>Empresa</th>
                  <th>Deseo</th>
                  <th>Servicio solicitado</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                  <th>Asignado a</th>
                  <th>Detalle</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                  <td><?= htmlspecialchars($row['nombre'] . ' ' . $row['apellidos']) ?></td>
                  <td><?= htmlspecialchars($row['empresa']) ?></td>
                  <td><?= htmlspecialchars($row['nombre_deseo']) ?></td>
                  <td>
                    <?php
                      if ($row['nombre_deseo'] === 'Información sobre un servicio') {
                        echo htmlspecialchars($row['nombre_servicio']);
                      } else {
                        echo 'N/A';
                      }
                    ?>
                  </td>
                  <td><?= htmlspecialchars($row['fecha_solicitud']) ?></td>
                  <td><?= htmlspecialchars($row['estado']) ?></td>
                  <td>
                    <a href="detalle_solicitud.php?id=<?= $row['id_solicitud'] ?>" class="btn btn-view">🔍 Ver solicitud</a>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </section>
      </main>
    </div>
  </div>
</body>
</html>
