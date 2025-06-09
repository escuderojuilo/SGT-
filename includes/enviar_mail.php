<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require "verificarcuenta.php";

function envmail($nombre, $mai, $tok){
//Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'juab12300147@gmail.com';                     //SMTP username
        $mail->Password   = 'bzheqgpfhoxxdbys'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('juab12300147@gmail.com', 'Admin');
        $mail->addAddress($mai, $nombre);     //Add a recipient
        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Bienvenido/a al Sistema de gestión de tickets";

        $mail->Body    = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Credencial de acceso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; background-color: #f5f7fa; font-family: "Segoe UI", Roboto, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 40px auto; background-color: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 15px rgba(0,0,0,0.06);}
        .header { background-color: #1b396a; color: white; padding: 30px 20px; text-align: center;}
        .header h1 { margin: 0; font-size: 22px; font-weight: 600;}
        .content { padding: 30px 25px; font-size: 16px; line-height: 1.6;}
        .content h2 { color: #1b396a; font-size: 20px; margin-top: 0;}
        .credentials { background-color: #f2f4f8; border-left: 4px solid #c62828; padding: 15px 20px; margin: 20px 0; border-radius: 4px;}
        .credentials strong { display: inline-block; width: 120px; color: #000;}
        .button-container { text-align: center; margin-top: 30px;}
        .button { display: inline-block; background-color: #c62828; color: #fff !important; text-decoration: none; padding: 12px 30px; font-weight: bold; border-radius: 6px; font-size: 15px;}
        .footer { background-color: #f1f1f1; padding: 15px 20px; font-size: 12px; text-align: center; color: #888;}
        @media only screen and (max-width: 600px) {
            .content { padding: 20px 15px;}
            .credentials strong { width: 100px;}
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenid@ al Sistema de gestion de tickets!</h1>
        </div>
        <div class="content">
            <h2>Hola, ' . htmlspecialchars($nombre) . ' 👋</h2>
            <p>Nos complace darte la bienvenida a nuestra plataforma. A continuación encontrarás tu <strong>correo de acceso</strong>:</p>
            <div class="credentials">
                <p><strong>Usuario:</strong> ' . htmlspecialchars($mai) . '</p>
            </div>
            <p>Para continuar con el acceso, es necesario confirmar previamente tu cuenta. Por favor, haz clic en el siguiente botón para completar el proceso de verificación:</p>
            <div class="button-container">
                <a href="http://192.168.115.85/RegistroExitoso.php?token='.$tok.'" . class="button">Confirmar registro</a>
            </div>
        </div>
        <div class="footer">
            Este mensaje fue enviado automáticamente. No respondas a este correo.
        </div>
    </div>
</body>
</html>
';
        
$mail->AltBody = 'Hola, ' . $nombre . '. Tu usuario es: ' . $mai . '. Confirma tu cuenta en: ' . "http://192.168.115.85/RegistroExitoso.php?token='.$tok.'";    

        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function contraseña($nombre, $mai){
//Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'juab12300147@gmail.com';                     //SMTP username
        $mail->Password   = 'bzheqgpfhoxxdbys'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('juab12300147@gmail.com', 'Admin');
        $mail->addAddress($mai, $nombre);     //Add a recipient
        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "Sistema de gestión de tickets";

        $mail->Body    = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Credencial de acceso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin: 0; background-color: #f5f7fa; font-family: "Segoe UI", Roboto, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 40px auto; background-color: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 15px rgba(0,0,0,0.06);}
        .header { background-color: #1b396a; color: white; padding: 30px 20px; text-align: center;}
        .header h1 { margin: 0; font-size: 22px; font-weight: 600;}
        .content { padding: 30px 25px; font-size: 16px; line-height: 1.6;}
        .content h2 { color: #1b396a; font-size: 20px; margin-top: 0;}
        .credentials { background-color: #f2f4f8; border-left: 4px solid #c62828; padding: 15px 20px; margin: 20px 0; border-radius: 4px;}
        .credentials strong { display: inline-block; width: 120px; color: #000;}
        .button-container { text-align: center; margin-top: 30px;}
        .button { display: inline-block; background-color: #c62828; color: #fff !important; text-decoration: none; padding: 12px 30px; font-weight: bold; border-radius: 6px; font-size: 15px;}
        .footer { background-color: #f1f1f1; padding: 15px 20px; font-size: 12px; text-align: center; color: #888;}
        @media only screen and (max-width: 600px) {
            .content { padding: 20px 15px;}
            .credentials strong { width: 100px;}
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenid@ al Sistema de gestion de tickets!</h1>
        </div>
        <div class="content">
            <h2>Hola, ' . htmlspecialchars($nombre) . ' 👋</h2>
            <p>Correo de recuperación de contraseñas <strong>correo de acceso</strong>:</p>
            <div class="credentials">
                <p><strong>Usuario:</strong> ' . htmlspecialchars($mai) . '</p>
            </div>
            <p>Para continuar con la actulizacion de contraeña, dar clic en le sigueinte enlace:</p>
            <div class="button-container">
                <a href="http://192.168.115.85/nueva-contraseña.php" . class="button">Confirmar registro</a>
            </div>
        </div>
        <div class="footer">
            Este mensaje fue enviado automáticamente. No respondas a este correo.
        </div>
    </div>
</body>
</html>
';
        
$mail->AltBody = 'Hola, ' . $nombre . '. Tu usuario es: ' . $mai . '. Para continuar con la actualización de contraseña, por favor visita: ' . "http://192.168.115.85/nueva-contraseña.php";    

        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
