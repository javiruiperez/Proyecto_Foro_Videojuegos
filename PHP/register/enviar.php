<?php

$nombre=$_POST["nombre"];
$correo=$_POST["email"];
 echo $nombre;
$asunto="Confirmar cuenta ForoGamers";
$carta="De: $nombre \n  ";
$carta .="Correo: $correo \n";
mail($correo,$asunto,$carta);
header('Location :mensajeEnviado.html');
?>