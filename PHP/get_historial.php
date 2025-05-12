<?php

// Activar errores (solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../PHP/conexion_s21sec.php';

session_start();

$estado = $_GET['estado'] ?? '';
$fecha_inicio = $_GET['fecha_inicio'] ?? '';
$fecha_fin = $_GET['fecha_fin'] ?? '';

$condiciones = [];

if (!empty($estado)) {
  $estado = mysqli_real_escape_string($conexion, $estado);
  $condiciones[] = "(he.estado_anterior = '$estado' OR he.estado_nuevo = '$estado')";
}

if (!empty($fecha_inicio)) {
  $fecha_inicio = mysqli_real_escape_string($conexion, $fecha_inicio);
  $condiciones[] = "DATE(he.fecha_cambio) >= '$fecha_inicio'";
}

if (!empty($fecha_fin)) {
  $fecha_fin = mysqli_real_escape_string($conexion, $fecha_fin);
  $condiciones[] = "DATE(he.fecha_cambio) <= '$fecha_fin'";
}

$filtroSQL = '';
if (!empty($condiciones)) {
  $filtroSQL = 'WHERE ' . implode(' AND ', $condiciones);
}

$query = "
  SELECT 
    he.id_historial,
    he.estado_anterior,
    he.estado_nuevo,
    he.fecha_cambio,
    he.cambiado_por,
    c.nombre AS nombre_cliente,
    c.apellidos,
    d.nombre_departamento,
    s.nombre_servicio
  FROM HistorialEstados he
  INNER JOIN Asignaciones a ON he.id_asignacion = a.id_asignacion
  INNER JOIN Solicitudes sol ON a.id_solicitud = sol.id_solicitud
  INNER JOIN Clientes c ON sol.id_cliente = c.id_cliente
  LEFT JOIN Departamentos d ON a.id_departamento = d.id_departamento
  LEFT JOIN Servicios s ON sol.id_servicio = s.id_servicio
  $filtroSQL
  ORDER BY he.fecha_cambio DESC
";

$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
  echo "Error en la consulta: " . mysqli_error($conexion);
}


