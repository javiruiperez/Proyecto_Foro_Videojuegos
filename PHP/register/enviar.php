<?php

$nombre=$datesform[NAME];
$correo=$datesform[EMAIL];
 echo $datesform[NAME];
$asunto="Confirmar cuenta ForoGamers";
$carta="De: $nombre \n  ";
$carta .="Correo: $correo \n";
mail($correo,$asunto,$carta);
header('Location :mensajeEnviado.html');
?>