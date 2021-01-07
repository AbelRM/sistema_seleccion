<?php

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$correo = $_POST['email'];
$mensaje = $_POST['message'];
$nombre = $_POST['name'];

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'nano.hostinglabs.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'selecciondiresa@amsoftperu.com';                 // SMTP username
$mail->Password = 'bocasuelta123';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('selecciondiresa@amsoftperu.com', 'DIRESA TACNA - Sistema seleccion');
$mail->addAddress($correo, $nombre);     

$mail->Subject = 'Recuperar contrase«Ða';
$mail->Body    = $mensaje;

if(!$mail->send()) {
    echo 'Error, mensaje no enviado';
    echo 'Error del mensaje: ' . $mail->ErrorInfo;
} else {
    echo 'El mensaje se ha enviado correctamente';
    
}