<?php
include $_SERVER['DOCUMENT_ROOT'] . '/21_Principal/PHP/conexion.php'; // Conexión con la base de datos
require $_SERVER['DOCUMENT_ROOT'] . '/21_Principal/php/vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el código se ha enviado y no está vacío
    if (!isset($_POST['codigo']) || empty($_POST['codigo'])) {
        echo "Por favor, ingresa el código de validación.";
        var_dump($_POST); // Para ver si el formulario está enviando el código correctamente
        exit();
    }

    $codigoIngresado = $_POST['codigo'];

    session_start();
    if (!isset($_SESSION['correo_validacion'])) {
        echo "No se encontró un correo de validación en la sesión.";
        exit();
    }

    $correo = $_SESSION['correo_validacion'];

    // Verificar si el código ingresado es correcto
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE correo = ? AND clave_validacion = ?");
    $stmt->bind_param("ss", $correo, $codigoIngresado);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Si el código es correcto, activar la cuenta
        $update = $conn->prepare("UPDATE usuarios SET estado = TRUE WHERE correo = ?");
        $update->bind_param("s", $correo);
        $update->execute();

        echo "Cuenta validada. ¡Puedes iniciar sesión!";
    } else {
        echo "Clave incorrecta. Se ha enviado un nuevo código.";

        // Generar un nuevo código de validación
        $nueva_clave = generarClave();
        $update = $conn->prepare("UPDATE usuarios SET clave_validacion = ? WHERE correo = ?");
        $update->bind_param("ss", $nueva_clave, $correo);
        $update->execute();

        // Reenviar el correo con el nuevo código
        $email = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $email->isSMTP();
            $email->Host = 'smtp.gmail.com';
            $email->SMTPAuth = true;
            $email->Username = 'tu_correo@gmail.com';
            $email->Password = 'contraseña_generada'; 
            $email->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $email->Port = 587;

            $email->setFrom('tu_correo@gmail.com', 'Soporte');
            $email->addAddress($correo);
            $email->Subject = 'Nuevo código de validación';
            $email->Body = generarCorreo($correo, $nueva_clave);
            $email->isHTML(true);

            $email->send();
            echo "Nuevo código enviado a tu correo.";
        } catch (Exception $e) {
            echo "Error al enviar el nuevo código: " . $email->ErrorInfo;
        }
    }
}

?>
