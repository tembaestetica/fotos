 <?php
// Verifica si se recibieron datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica que todos los campos requeridos estén completados y que el email sea válido
    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor completa todos los campos requeridos y proporciona un email válido.";
        exit();
    }

    // Sanitiza los datos de entrada
    $name = strip_tags(htmlspecialchars(trim($_POST['name'])));
    $email = strip_tags(htmlspecialchars(trim($_POST['email'])));
    $m_subject = strip_tags(htmlspecialchars(trim($_POST['subject'])));
    $message = strip_tags(htmlspecialchars(trim($_POST['message'])));

    $to = "tembaestetica@gmail.com"; // Cambia este correo por el tuyo
    $subject = "Nuevo mensaje de contacto de: $name - $m_subject";
    $body = "Has recibido un nuevo mensaje desde tu formulario de contacto.\n\n".
            "Nombre: $name\n".
            "Email: $email\n".
            "Asunto: $m_subject\n".
            "Mensaje:\n$message";

    // Configuración de los encabezados del correo
    $header = "From: <$email>\r\n"; // Asegúrate de que el remitente esté en el formato adecuado
    $header .= "Reply-To: $email\r\n";	
    $header .= "Content-Type: text/plain; charset=utf-8\r\n"; // Centro de contenido

    // Envía el correo y maneja el resultado
    if (mail($to, $subject, $body, $header)) {
        http_response_code(200);
        echo "Gracias por tu mensaje. Te responderemos lo más pronto posible.";
    } else {
        http_response_code(500);
        echo "Hubo un error al enviar tu mensaje. Intenta de nuevo más tarde.";
