<?php
require("../modelo/classModelo.php");
require("../modelo/classUsuario.php");
require("../BaseDeDatos/config.php");
include("../libs/bGeneral.php");
 session_start();

 if(isset($_SESSION["user"])){
    try{
    
        $usuario = new Usuario();

        $usuarioBuscado = $usuario->getUser($_SESSION["user"]);
        $emailBuscado= $usuario->getEmail($_SESSION["user"]);
        $nombreBuscado=$usuario->getNombre($_SESSION["user"]);

    } catch(PDOException $e){
        error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
        // guardamos en ·errores el error que queremos mostrar a los usuarios
        $erroresGuide['NoGuide'] = "Ha habido un error <br>";
    }
    
$dir = "../../img";
/**
 * Tamaño máximo aceptado, si queremos que sea inferior al configurado en php.ini
 **/
$max_file_size = "512000000";
/**
 * Creamos una lista de extensiones permitidas, por seguridad es lo más válido.
 */
$extensionesValidas = array(
    "jpg",
    "png",
    "gif"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/Index.css">
 
    <title>ForoGamers</title>
    <style>
form{
    width:400px;
    border:1px solid white;
    text-align:center;
    background-color:black;
    color:white;
    margin :0 auto;
}

        </style>
</head>
<body>
    <header>
        <nav>
            <div class="grid-container">
                <div class="col-1"><a href="../../HTML/Index.php"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="col-2">
                <form action="">                
                  <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
              </form></div>
                <div class="col-3"><a href="../register/registro.php" class="sign-In">Sign up</a><a href="../login/checkLogin.php" class="log-In">Log in</a></div>
            </div>
          
        </nav>
    </header>
    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="box"><img src="../../img/image.png" ></div>
            <label>Nombre</label><br>
            <label><?php echo  $nombreBuscado  ?></label><br>
            <label>User</label><br>
            <label><?php echo  $usuarioBuscado  ?></label><br>
            <label>Email</label><br>
            <label><?php echo  $emailBuscado  ?></label><br>
          
    <input type="file" name="imagen" id="imagen" />
            
           <br>
           <input type="submit" class="buttonForm" name="submit" value="bAceptar"/>
           <input type="button" name="Cancelar" value="Cancelar" onClick="perfil.php">

            <br>
            <a href="cerrarSession.php" class="CerrarSession">CerrarrSession</a>
        </form>

    <footer>
        <div class="footer">
            <div class="row">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our services</a></li>
                    <li><a href="#" download>Privacy politics</a></li>
                    <li><a href="#" download>Terms and conditions</a></li>
                </ul>
            </div>
            <div class="row">
                ForoGamers Copyright © 2023 FG - All rights reserved || Designed By: Javier Ruiperez, Fran Botella, Oscar Delicado
            </div>
        </div>
    </footer>
</body>
</html>

<?php

if (isset($_REQUEST['submit'])) {
 
if (!isset($_FILES['imagen'])) {
    $errores["imagen"] = "Error en la imagen";
  
} else {

        /**
         * Guardamos el nombre original del fichero
         **/
 
        $nombreArchivo = $_FILES['imagen']['name'];
        /*
         * Guardamos nombre del fichero en el servidor
        */
        $directorioTemp = $_FILES['imagen']['tmp_name'];
        /*
         * Calculamos el tamaño del fichero
        */
        //directoriotemp es igual a fichero
        $tamanyoFile = filesize($directorioTemp);
        /*
        * Extraemos la extensión del fichero, desde el último punto. Si hubiese doble extensión, no lo
        * tendría en cuenta.
        */
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

     
    
    
            /**
             * 
             * Tenemos que buscar un nombre único para guardar el fichero de manera definitiva
             * Añadimos microtime() al nombre del fichero si ya existe un archivo guardado con ese nombre.
             * */
            //directory_separator es igual a \
            $nombreArchivo = is_file($dir . DIRECTORY_SEPARATOR . $nombreArchivo) ? time() . $nombreArchivo : $nombreArchivo;
            $nombreCompleto = $dir . DIRECTORY_SEPARATOR . $nombreArchivo;
            /**
             * Movemos el fichero a la ubicación definitiva.
             * */
            

             if(isset($image) &&  $nombreArchivo != ""){
                $type =  $extension;
                $size = $tamanyoFile;
                $temp = $nombreArchivo;

                if(!((strpos($type, "jpg") || strpos($type, "png") || strpos($type, "jpeg")) && ($size < 2000000))){
                    echo "Error with the profile picture";
                } else{
                    if(is_file("../../img/".$username."/".$image)){
                        $image = time() . $image;
                    }
                    if(move_uploaded_file($temp, '../../img/'.$username.'/'.$image)){
                        echo  "imagen subida";
                    } else{
                        echo "error al subir la imagen";
                    }
                }
            } else{
                echo "imagen vacía";
            }



        
    
}
}
else{
    echo "No entra";
}

}else{
    header("Location:../../HTML/Index.php");
}
?>