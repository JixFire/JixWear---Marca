<?php
/*
 *  Configurar depende al correo
 */

//una dirección de correo electrónico que estará en el campo De del correo electrónico.
$from = 'Demo contact form <demo@domain.com>';

//una dirección de correo electrónico que recibirá el correo electrónico con la salida del formulario
$sendTo = 'Demo contact form <daniel03valencia@gmail.com>';


// asunto del correo electrónico
$subject = 'Nuevo mensaje de ';

// formar nombres de campos y sus traducciones.
// nombre de la variable de matriz => Texto que aparecerá en el correo electrónico
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message'); 

// mensaje que se mostrará cuando todo esté bien :)
$okMessage = 'Formulario de contacto enviado correctamente. Gracias, te responderé pronto.!';

//Si algo sale mal, mostraremos este mensaje.
$errorMessage = 'Hubo un error al enviar el formulario. Por favor, inténtelo de nuevo más tarde';

/*
 *  HAGAMOS EL ENVÍO
 */

//si no está depurando y no necesita informes de errores, desactívelo mediante error_reporting (0);
error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "You have a new message from your contact form\n=============================\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    // Necesario para el email
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    // Envio de email
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


//si lo solicita la solicitud AJAX, devuelva la respuesta JSON
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// si no, solo muestra el mensaje
else {
    echo $responseArray['message'];
}
