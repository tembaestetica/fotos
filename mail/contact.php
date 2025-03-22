<?php
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Código de estado 400 para solicitud incorrecta
    echo json_encode(["message" => "Por favor, complete todos los campos requeridos."]);
    exit();
}

$name = strip_tags(htmlspecialchars(trim($_POST['name'])));
$email = strip_tags(htmlspecialchars(trim($_POST['email'])));
$m_subject = strip_tags(htmlspecialchars(trim($_POST['subject'])));
$message = strip_tags(htmlspecialchars(trim($_POST['message'])));

$to = "info@example.com"; // Cambia este correo al que deseas recibir los mensajes
$subject = "$m_subject: $name";
$body = "Has recibido un nuevo mensaje desde tu formulario de contacto.\n\n".
        "Aquí están los detalles:\n\n".
        "Nombre: $name\n\n".
        "Email: $email\n\n".
        "Asunto: $m_subject\n\n".
        "Mensaje: $message";

$headers = "From: $email\r\n";  // Especifica el remitente
$headers .= "Reply-To: $email\r\n"; // Especifica la dirección de respuesta
$headers .= "Content-Type: text/plain; charset=utf-8\r\n"; // Establece el tipo de contenido

if (!mail($to, $subject, $body, $headers)) {
    http_response_code(500); // Código de estado 500 para error interno del servidor
    echo json_encode(["message" => "Hubo un error al enviar su mensaje. Por favor, inténtelo de nuevo más tarde."]);
    exit();
}

// Si se envió correctamente
http_response_code(200); // Código de estado 200 para éxito
echo json_encode(["message" => "Mensaje enviado con éxito."]);
?>
