<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['ID_Usuario'])) {
    header("Location: ../HTML/inicio_sesion.html");
    exit();
}

// Mensaje personalizado con el nombre del usuario
$nombre = $_SESSION['Nombre'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f4f9;
        }
        .welcome-message {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="welcome-message">
        <h2>¡Bienvenido, <?php echo htmlspecialchars($nombre); ?>!</h2>
        <p>Serás redirigido a la página principal en 3 segundos...</p>
    </div>
    
    <script>
        setTimeout(function() {
            window.location.href = "../HTML/s21sec.html";
        }, 3000);
    </script>
</body>
</html> 