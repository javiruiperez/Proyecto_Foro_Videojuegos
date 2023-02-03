<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include("../libs/bGeneral.php");
require("../modelo/classModelo.php");
require("../modelo/classUsuario.php");
require("../BaseDeDatos/config.php");

//Crear una instancia. Con true permitimos excepciones
$mail = new PHPMailer(true);

//  $newPass = randomPassword();
//  $passwordBD = $usuarioEmail->modifyPassword($newPass, $email);
// $emailGet=$usuarioEmail->getEmail($_SESSION["user"]);
//  $to = $emailGet;
//  $subject = "Recuperar Contraseña";
//  $headers = "MIME-Version: 1.0" . "\r\n";
//  $headers .= "Contenttype:text/html;charset=UTF-8" . "\r\n";
//  $message = "Tu nueva contraseña es".$newpass;
//  mail($to, $subject, $message, $headers);


 session_start();
 if (isset($_SESSION["user"])) {
     header("location:../../HTML/Index.php");
 }
 try {
    //Valores dependientes del servidor que utilizamos
    
    $mail->isSMTP();                                           //Para usaar SMTP
    $mail->Host       = 'forogamershelp@gmail.com';                     //Nuestro servidor SMTMP smtp.gmail.com en caso de usar gmail
    $mail->SMTPAuth   = true;    
    /* 
    * SMTP username y password Poned los vuestros. La contraseña es la que nos generó GMAIL
    */
    $mail->Username   = 'forogamershelp@gmail.com';             
    $mail->Password   = 'vumtfxjkjxraedol';    
    /*
    * Encriptación a usar ssl o tls, dependiendo cual usemos hay que utilizar uno u otro puerto
    */            
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
    $mail->Port = "465";
    /**TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`                         
     * $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     * $mail->Port       = 587;  
     */


    /*
    Receptores y remitente
    */
$usuarioEmail=new Usuario();

    $newPass = randomPassword();
 $passwordBD = $usuarioEmail->modifyPassword($newPass, $email);
$emailGet=$usuarioEmail->getEmail($_SESSION["user"]);
//Remitente
    $mail->setFrom('forogamershelp@gmail.com', 'forogamershelp');
//Receptores. Podemos añadir más de uno. El segundo argumento es opcional, es el nombre
    $mail->addAddress($emailGet, 'prueba');     //Add a recipient
    //$mail->addAddress('ejemplo@example.com'); 

    //Copia
    //$mail->addCC('cc@example.com');
    //Copia Oculta
    //$mail->addBCC('bcc@example.com');

    //Archivos adjuntos
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Contenido
    //Si enviamos HTML
    $mail->isHTML(true);    
    $mail->CharSet = "UTF8";    
    //Asunto
    $mail->Subject = 'Recuperar Contraseña';
    //Conteido HTML
    $mail->Body    = "Tu nueva contraseña es".$newpass;
    //Contenido alternativo en texto simple
    $mail->AltBody = "Tu nueva contraseña es".$newpass;
    //Enviar correo
    $mail->send();
    echo 'El mensaje se ha enviado con exito';
} catch (Exception $e) {
    echo "El mensaje no se ha enviado: {$mail->ErrorInfo}";
    
}
?>