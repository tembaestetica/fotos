<?php
// Asegúrate de que la solicitud es un POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = json_decode(file_get_contents('php://input'), true);
    
    $to = 'tembaestetica@gmail.com'; // Tu dirección de correo
    $subject = 'Nuevo evento de GitHub';
    $body = "Recibido un nuevo evento:\n\n" . print_r($payload, true);
    
    $headers = "From: noreply@tu-dominio.com\r\n"; // Cambia esto a un correo válido
    
    // Enviar el email
    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Error en el envío
    }
} else {
    http_response_code(405); // Método no permitido
}
?>
