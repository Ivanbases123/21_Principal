<?php

include $_SERVER['DOCUMENT_ROOT'] . '/21_Principal/PHP/conexion.php';

// Recoger los datos del formulario
$empresa = $conn->real_escape_string($_POST['empresa']);
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellidos = $conn->real_escape_string($_POST['apellidos']);
$pais = $conn->real_escape_string($_POST['pais']);
$ciudad = $conn->real_escape_string($_POST['ciudad']);
$email = $conn->real_escape_string($_POST['email']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$cargo = $conn->real_escape_string($_POST['cargo']);
$tamano_empresa = $conn->real_escape_string($_POST['tamano_empresa']);
$sector_empresa = $conn->real_escape_string($_POST['sector_empresa']);
$deseo = $conn->real_escape_string($_POST['deseo']);
$mensaje = $conn->real_escape_string($_POST['mensaje']);
$recibir_info = intval($_POST['recibir_info']);

// Insertar datos en la tabla principal
$sql = "INSERT INTO formu_cliente (empresa, nombre, apellidos, pais, ciudad, email, telefono, cargo, tamano_empresa, sector_empresa, deseo, mensaje, recibir_info)
        VALUES ('$empresa', '$nombre', '$apellidos', '$pais', '$ciudad', '$email', '$telefono', '$cargo', '$tamano_empresa', '$sector_empresa', '$deseo', '$mensaje', $recibir_info)";

if ($conn->query($sql) === TRUE) {
    $cliente_id = $conn->insert_id;
    
    // Si seleccionó información sobre un servicio, insertar en la tabla deseo_informacion
    if ($deseo === 'Información sobre un servicio' && isset($_POST['informacion'])) {
        $informacion = $conn->real_escape_string($_POST['informacion']);
        $sql_info = "INSERT INTO deseo_informacion (cliente_id, informacion) VALUES ($cliente_id, '$informacion')";
        $conn->query($sql_info);
    }
    
    // Redirigir a página de éxito
    header('Location: gracias.html');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>