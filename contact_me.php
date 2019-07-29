<?php
require 'PHPMailerAutoload.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');
// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
//$email_to = "sdesigncba@gmail.com";
//$email_to = "carlosdanielgutierrez@gmail.com";


// $email_to ="info@ralseff.com";

$name = $_REQUEST['nombre'];
$last = $_REQUEST['apellido'];
$tel = $_REQUEST['telefono'];
$email = $_REQUEST['email'];
$obra = $_REQUEST['obra'];
$mensaje = $_REQUEST['mensaje'];


$email_subject = "Consulta campaña Clínica de ojos";

// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['nombre']) ||
!isset($_POST['apellido']) ||
!isset($_POST['telefono']) ||
!isset($_POST['email']) ||
!isset($_POST['obra'])) {

echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
die();
}

// $email_message = "Detalles del formulario :\n\n";
// $email_message .= "Nombre: " . $_POST['name'] . "\n";
// $email_message .= "Whatsapp: " . $_POST['wp'] . "\n";
// $email_message .= "Mensaje: " . $_POST['consulta'] . "\n";
$email_message2 = "<h1>Detalles del formulario :</h1><br>";
$email_message2 .= "<p>Nombre: " . $_POST['nombre'] ."</p>";
$email_message2 .= "<p>Apellido: " . $_POST['apellido'] ."</p>";
$email_message2 .= "<p>Teléfono: " . $_POST['telefono'] ."</p>";
$email_message2 .= "<p>Mail: " . $_POST['email'] ."</p>";
$email_message2 .= "<p>Obra social: " . $_POST['obra'] ."</p>";
$email_message2 .= "<p>Mensaje: " . $_POST['mensaje'] ."</p>";

//inicio script grabar datos en csv
$fichero = 'consultas landing.csv';//nombre archivo ya creado
//crear linea de datos separado por coma
$fecha=date("d-m-y H:i:s");
$linea = $fecha.";".$name.";".$last.";".$tel.";".$email.";".$obra.";".$mensaje."\n";
// Escribir la linea en el fichero
file_put_contents($fichero, $linea, FILE_APPEND | LOCK_EX);
//fin grabar datos
// $message=$message.' local='.$local;
// $mail = new PHPMailer;
// $mail->isSMTP();

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';

$mail->Host = 'mail.clinicasantaluciasalta.com';
$mail->Port = 2525;
$mail->SMTPAuth = true;
$mail->SMTPSecure = false;
$mail->SMTPAutoTLS = false;
// $mail->SMTPOptions = array(
//     'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//     )
// );
$mail->Username = 'info-clinicasantaluciasalta.com';
$mail->Password = 'santsalta159';
$mail->setFrom($email, $name);

$mail->addReplyTo('info@clinicasantaluciasalta.com','Clínica Santa Lucía');

$mail->addAddress('sdesigncba@gmail.com','Clínica Santia Lucia'); //turnosexpresssantalucia@gmail.com
// $mail->addCc('cristiancastro.pr1991@gmail.com','Clínica Santia Lucia');
// $mail->addCc('quirofanosantaluciasalta@gmail.com','Clínica Santia Lucia');
$mail->isHTML(true);
$mail->Subject = $email_subject;
$mail->Body    = $email_message2;
// $mail->AltBody = $email_message;

$mail->CharSet = 'UTF-8';
if (!$mail->send()) {
    $mail_enviado=false;
    $mail_error .= 'Mailer Error: '.$mail->ErrorInfo;
} else {
    $mail_enviado=true;
    $mail_error='Mensaje Enviado, Gracias';
}
// Ahora se envía el e-mail usando la función mail() de PHP
//$headers = 'From: Ralseff <info@ralseff.com>' . "\r\n" .
//    'Reply-To: noreply@ralseff.com' . "\r\n" .
//    'Cc: ralseff@chimpancedigital.com.ar' . "\r\n" .
//    'X-Mailer: PHP/' . phpversion();
//$mail_enviado = @mail($email_to, utf8_decode($email_subject), utf8_decode($email_message), $headers);


if($mail_enviado)
{
echo "<script>location.href='gracias.html';</script>";

}
else
{
	echo "no se pudo enviar" ;
}

// Envia un e-mail para el remitente, agradeciendo la visita en el sitio, y diciendo que en breve el e-mail sera respondido. 
// $mensaje2  = "Hola" . $_POST['name'] . ". Gracias por contactarnos. Un asesor se comunicará con usted a la brevedad..."; 
// $mensaje2 .= "PD - No es necesario responder este mensaje."; 
// $envia =  mail($_POST['email'],"Su mensaje fué recibido!",$mensaje2,$headers);



?>