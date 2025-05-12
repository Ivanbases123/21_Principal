<?php
include 'get_detalle_solicitud.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../CSS/stylesDashboard.css" />
  <title>Detalle de Solicitud</title>
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
        <h1>Detalle de Solicitud</h1>
      </header>
      <main class="main-content">
        <section class="detalle-solicitud">

          <h2>1. Datos del Cliente</h2>
          <ul>
            <li><strong>Empresa:</strong> <?php echo $cliente['empresa']; ?></li>
            <li><strong>Nombre:</strong> <?php echo $cliente['nombre'] . ' ' . $cliente['apellidos']; ?></li>
            <li><strong>País:</strong> <?php echo $cliente['pais']; ?></li>
            <li><strong>Ciudad:</strong> <?php echo $cliente['ciudad']; ?></li>
            <li><strong>Email:</strong> <?php echo $cliente['email']; ?></li>
            <li><strong>Cargo:</strong> <?php echo $cliente['cargo']; ?></li>
            <li><strong>Teléfono:</strong> <?php echo $cliente['telefono']; ?></li>
            <li><strong>Tamaño Empresa:</strong> <?php echo $tamanoempresa['descripcion']; ?></li>
            <li><strong>Sector empresarial:</strong> <?php echo $sectorempresa['descripcion']; ?></li>
          </ul>

          <h2>2. Datos de la Solicitud</h2>
          <ul>
            <li><strong>Deseo:</strong> <?php echo $deseo; ?></li>
            <li><strong>Servicio:</strong> <?php echo $servicio ?: 'No especificado'; ?></li>
            <li><strong>Mensaje:</strong> <?php echo $solicitud['mensaje']; ?></li>
            <li><strong>Fecha de Solicitud:</strong> <?php echo $solicitud['fecha_solicitud']; ?></li>
          </ul>

          <h2>3. Estado Actual y Asignación</h2>
          <ul>
            <li><strong>Estado:</strong> <?php echo $asignacion['estado'] ?? 'No asignado'; ?></li>
            <li><strong>Departamento:</strong> <?php echo $departamento ?? 'No asignado'; ?></li>
            <li><strong>Fecha de asignación:</strong> <?php echo $asignacion['fecha_asignacion'] ?? 'N/A'; ?></li>
          </ul>

          <h2>4. Historial de Estados</h2>
          <table>
            <thead>
              <tr><th>De</th><th>A</th><th>Fecha</th><th>Usuario</th></tr>
            </thead>
            <tbody>
              <?php foreach ($historialEstados as $historial) : ?>
              <tr>
                <td><?php echo $historial['estado_anterior']; ?></td>
                <td><?php echo $historial['estado_nuevo']; ?></td>
                <td><?php echo $historial['fecha']; ?></td>
                <td><?php echo $historial['usuario']; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <h2>5. Acciones Disponibles</h2>
          <form method="POST" action="actualizar_acciones.php">

            <!-- Campo oculto para pasar el ID de solicitud -->
            <input type="hidden" name="id_solicitud" value="<?php echo $id_solicitud['id_solicitud']; ?>">

            <label for="nuevo_estado">Cambiar estado:</label>
            <select name="nuevo_estado" id="nuevo_estado" required>
              <option value="En proceso" <?php if(($asignacion['estado'] ?? '') === 'En proceso') echo 'selected'; ?>>En proceso</option>
              <option value="Finalizado" <?php if(($asignacion['estado'] ?? '') === 'Finalizado') echo 'selected'; ?>>Finalizado</option>
            </select>

            <label for="nuevo_departamento">Editar asignación:</label>
            <select name="nuevo_departamento" id="nuevo_departamento" required>
              <?php foreach ($departamentos as $dep_resultado) : ?>
                <option value="<?php echo $dep_resultado['id_departamento']; ?>" 
                  <?php if(($asignacion['id_departamento'] ?? '') == $dep_resultado['id_departamento']) echo 'selected'; ?>>
                  <?php echo $dep_resultado['nombre_departamento']; ?>
                </option>
              <?php endforeach; ?>
            </select>

            <label for="respuesta">Añadir respuesta:</label>
            <textarea name="respuesta" id="respuesta" rows="4" required></textarea>

            <button type="submit" class="btn btn-new">Reasignar</button>
          </form>
        </section>
      </main>
      <?php mysqli_close($conexion); ?>
    </div>
  </div>
</body>
</html>

