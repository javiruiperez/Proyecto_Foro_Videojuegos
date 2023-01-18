<?php
    function enviaMail($mail, $pass){
        $subject = "Account Recovery - ForoGamers";
        $message = "We received an account recovery request on ForoGamers for ".$mail.". <br> This is your new password: " .$pass."<br> Please log in into your account now.";
        $headers = 'From: webmaster@example.com'       . "\r\n" .
        'Reply-To: noreply@forogamers.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
        if(mail($mail, $subject, $message, $headers)){
            echo "email enviado";
        } else{
            echo "email NO enviado";
        }
    }

    $correo = "oscardelicadohernandez@gmail.com";
    $pass = "dshfiudshfdsf";

    enviaMail($correo, $pass);
?>