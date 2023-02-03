<?php
$to = "franbotella97@gmail.com";
$subject = "Asunto del email";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Contenttype:text/html;charset=UTF-8" . "\r\n";
$message = "Hola";
mail($to, $subject, $message, $headers);
?>




