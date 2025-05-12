<?php
// Activar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a base de datos
require_once '../PHP/conexion_s21sec.php';

// Validación de datos recibidos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_solicitud = $_POST['id_solicitud'] ?? null;
    $nuevo_estado = $_POST['nuevo_estado'] ?? null;
    $nuevo_departamento = $_POST['nuevo_departamento'] ?? null;
    $mensaje = $_POST['respuesta'] ?? '';
    $usuario = "admin"; // Aquí deberías usar $_SESSION['usuario'] si tienes login implementado

    if (!$id_solicitud || !$nuevo_estado || !$nuevo_departamento) {
        die("Faltan datos para actualizar.");
    }

    // Obtener datos actuales de la asignación para registrar en historial
    $query_asignacion = "SELECT id_asignacion, estado FROM Asignaciones WHERE id_solicitud = $id_solicitud";
    $resultado_asignacion = mysqli_query($conexion, $query_asignacion);

    if (!$resultado_asignacion || mysqli_num_rows($resultado_asignacion) === 0) {
        die("No se encontró la asignación.");
    }

    $asignacion = mysqli_fetch_assoc($resultado_asignacion);
    $estado_anterior = $asignacion['estado'];
    $id_asignacion = $asignacion['id_asignacion'];
    $fecha_actual = date('Y-m-d H:i:s');

    // Actualizar la asignación
    $update_query = "
        UPDATE Asignaciones 
        SET 
            estado = '$nuevo_estado',
            id_departamento = $nuevo_departamento,
            mensaje_asignacion = '" . mysqli_real_escape_string($conexion, $mensaje) . "',
            fecha_asignacion = '$fecha_actual'
        WHERE id_solicitud = $id_solicitud
    ";

    if (mysqli_query($conexion, $update_query)) {
        // Registrar en historial
        $insert_historial = "
            INSERT INTO HistorialEstados (
                id_asignacion, 
                estado_anterior, 
                estado_nuevo, 
                fecha_cambio, 
                cambiado_por
            ) VALUES (
                $id_asignacion,
                '$estado_anterior',
                '$nuevo_estado',
                '$fecha_actual',
                '" . mysqli_real_escape_string($conexion, $usuario) . "'
            )
        ";
        mysqli_query($conexion, $insert_historial);

        // Redirigir de nuevo a la página de detalle
        header("Location: detalle_solicitud.php?id=$id_solicitud");
        exit();
    } else {
        echo "Error al actualizar la asignación: " . mysqli_error($conexion);
    }
} else {
    echo "Método de solicitud no permitido.";
}

mysqli_close($conexion);
?>

