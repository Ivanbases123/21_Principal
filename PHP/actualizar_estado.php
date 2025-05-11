<?php
// Activar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "1234", "s21sec");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar que se recibió el estado y la solicitud
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nuevo_estado']) && isset($_POST['id_solicitud'])) {
    $nuevo_estado = mysqli_real_escape_string($conexion, $_POST['nuevo_estado']);
    $id_solicitud = intval($_POST['id_solicitud']);

    // Actualizar estado en la tabla Asignaciones
    $query = "UPDATE Asignaciones SET estado = '$nuevo_estado' WHERE id_solicitud = $id_solicitud";

    if (mysqli_query($conexion, $query)) {
        // Redirigir de vuelta al detalle de la solicitud
        header("Location: detalle_solicitud.php?id=$id_solicitud");
        exit();
    } else {
        echo "Error al actualizar el estado: " . mysqli_error($conexion);
    }
} else {
    echo "Datos incompletos para actualizar el estado.";
}

mysqli_close($conexion);
?>

