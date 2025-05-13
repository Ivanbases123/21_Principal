<?php
session_start();

// Verificar si el usuario está validado
if (!isset($_SESSION['Nombre'])) {
    header("Location: inicio_sesion.html");
    exit();
}

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
        <h2>¡Validación exitosa, <?php echo htmlspecialchars($nombre); ?>!</h2>
        <p>Serás redirigido a la página de inicio de sesión en 3 segundos...</p>
    </div>
    
    <script>
        setTimeout(function() {
            window.location.href = "inicio_sesion.html";
        }, 3000);
    </script>
</body>
</html>