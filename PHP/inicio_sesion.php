<?php
include $_SERVER['DOCUMENT_ROOT'] . '/21_Principal/PHP/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 1. Verificar credenciales
    $stmt = $conn->prepare("SELECT id, nombre_completo, password FROM Usuarios WHERE correo = ? AND estado = TRUE");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        // 2. Validar contraseña
        if (password_verify($password, $usuario['password'])) {
            // 3. Guardar datos en sesión
            $_SESSION['ID_Usuario'] = $usuario['id'];
            $_SESSION['Nombre'] = $usuario['nombre_completo'];
            
            // 4. Redirigir a welcome.php
            header("Location: welcome.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado o cuenta no validada.";
    }
    $stmt->close();
}
?>