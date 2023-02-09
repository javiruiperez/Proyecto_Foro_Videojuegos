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
    try {
        $mail->isSMTP(); //Para usaar SMTP
        $mail->Host       = 'smtp.gmail.com';//Nuestro servidor SMTMP smtp.gmail.com en caso de usar gmail
        $mail->SMTPAuth   = true;    
        /* 
        * SMTP username y password Poned los vuestros. La contraseña es la que nos generó GMAIL
        */
        $mail->Username   = 'forogamershelp@gmail.com';             
        $mail->Password   = 'mglk frwc fgws ydng';    
        /*
        * Encriptación a usar ssl o tls, dependiendo cual usemos hay que utilizar uno u otro puerto
        */            
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
        $mail->Port = "465";
        /*TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`                         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;  
        Receptores y remitente
        */
        $usuarioEmail=new Usuario();
        $newPass = randomPassword();
  
        $emailGet=$_GET['variable1'];
 
        $passwordBD = $usuarioEmail->modifyPassword($newPass, $emailGet);
        $getpassword=$usuarioEmail-> getPassword($emailGet);
   
        //Remitente
            $mail->setFrom('franbotella97@gmail.com', 'forogamershelp');
        //Receptores. Podemos añadir más de uno. El segundo argumento es opcional, es el nombre
        $mail->addAddress($emailGet);     //Add a recipient
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
        $mail->Body    = "Tu nueva contraseña es". $getpassword;
        //Contenido alternativo en texto simple
        $mail->AltBody = "Tu nueva contraseña es". $getpassword;
        //Enviar correo
        $mail->send();
        echo 'El mensaje se ha enviado con exito';
        echo "Mira tu correo que se envio tu nueva contraseña";
        header( "Refresh:5;url=../../HTML/Index.php" );
   
    } catch (Exception $e) {
        echo "El mensaje no se ha enviado: {$mail->ErrorInfo}";
    }

?>