<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $correo = htmlspecialchars($_POST['correo']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Validar el correo
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Configuración del correo
        $to = "tucorreo@gmail.com";  // Cambia esto por tu dirección de correo
        $subject = "Nuevo mensaje de contacto";
        $body = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";
        $headers = "From: $correo";

        // Enviar correo
        if (mail($to, $subject, $body, $headers)) {
            echo "Mensaje enviado con éxito.";
        } else {
            echo "Error al enviar el mensaje. Intente más tarde.";
        }
    } else {
        echo "Por favor, ingrese un correo electrónico válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
</head>
<body>
    <h2>Contacto</h2>
    <form action="contacto.php" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br>
        <label for="mensaje">Mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" required></textarea><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
