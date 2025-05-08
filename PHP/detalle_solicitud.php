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
        <a href="#pendientes">📥 Solicitudes pendientes</a>
        <a href="#procesos">⏳ Solicitudes en proceso</a>
        <a href="#finalizadas">✅ Solicitudes finalizadas</a>
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
            <li><strong>Nombre:</strong> <?php echo $cliente['nombre'] . ' ' . $cliente['apellidos']; ?></li>
            <li><strong>Empresa:</strong> <?php echo $cliente['empresa']; ?></li>
            <li><strong>Cargo:</strong> <?php echo $cliente['cargo']; ?></li>
            <li><strong>Email:</strong> <?php echo $cliente['email']; ?></li>
            <li><strong>Teléfono:</strong> <?php echo $cliente['telefono']; ?></li>
            <li><strong>País y Ciudad:</strong> <?php echo $cliente['pais'] . ', ' . $cliente['ciudad']; ?></li>
          </ul>

          <h2>2. Datos de la Solicitud</h2>
          <ul>
            <li><strong>Servicio:</strong> <?php echo $servicio; ?></li>
            <li><strong>Deseo:</strong> <?php echo $deseo; ?></li>
            <li><strong>Mensaje:</strong> <?php echo $solicitud['mensaje']; ?></li>
            <li><strong>Fecha de Solicitud:</strong> <?php echo $solicitud['fecha_solicitud']; ?></li>
          </ul>

          <h2>3. Estado Actual y Asignación</h2>
          <ul>
            <li><strong>Estado:</strong> <?php echo $asignacion['estado']; ?></li>
            <li><strong>Departamento:</strong> <?php echo $departamento; ?></li>
            <li><strong>Fecha de asignación:</strong> <?php echo $asignacion['fecha_asignacion']; ?></li>
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

          <h2>5. Respuestas Enviadas</h2>
          <table>
            <thead>
              <tr><th>Fecha</th><th>Respuesta</th><th>Respondido por</th></tr>
            </thead>
            <tbody>
              <?php foreach ($respuestas as $respuesta) : ?>
              <tr>
                <td><?php echo $respuesta['fecha_respuesta']; ?></td>
                <td><?php echo $respuesta['respuesta']; ?></td>
                <td><?php echo $respuesta['respondido_por']; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <h2>6. Acciones Disponibles</h2>
          <form method="POST" action="actualizar_estado.php">
            <label for="nuevo_estado">Cambiar estado:</label>
            <select name="nuevo_estado" id="nuevo_estado">
              <option value="En proceso">En proceso</option>
              <option value="Finalizado">Finalizado</option>
            </select>
            <button type="submit" class="btn btn-edit">Actualizar</button>
          </form>

          <form method="POST" action="reasignar_departamento.php">
            <label for="nuevo_departamento">Editar asignación:</label>
            <select name="nuevo_departamento" id="nuevo_departamento">
              <?php foreach ($departamentos as $dpto) : ?>
              <option value="<?php echo $dpto['id_departamento']; ?>">
                <?php echo $dpto['nombre_departamento']; ?>
              </option>
              <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-edit">Reasignar</button>
          </form>

          <form method="POST" action="agregar_respuesta.php">
            <label for="respuesta">Añadir respuesta:</label>
            <textarea name="respuesta" id="respuesta" rows="4" required></textarea>
            <button type="submit" class="btn btn-new">Enviar</button>
          </form>

        </section>
      </main>
    </div>
  </div>
</body>
</html>
