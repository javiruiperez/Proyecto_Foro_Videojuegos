<?php
require("../modelo/classModelo.php");
require("../modelo/classUsuario.php");
require("../BaseDeDatos/config.php");
require("../modelo/classAdmin.php");
session_start();

if(!isset($_SESSION["user"])){
    header("Location:../../HTML/Index.php");
}else{
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

    $nombreArchivo = "";
    $dir = "../../img";
    $max_file_size = "51200000";
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
              <div class="col-3"><a href="perfil.php" class="sign-In">Usuario</a></div>
            </div>
          
        </nav>
    </header>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="box"><img src=
            <?php
                echo "../../img/".$usuarioBuscado."/image.png"; 
            ?>></div>
            <label>Nombre</label><br>
            <input type="text" value="<?php echo $nombreBuscado?>" name="Nombre" id="Nombre" class="pendiente"></label><br>
            <label>User</label><br>
            <label><?php echo $usuarioBuscado?></label><br>
            <label>Email</label><br>
            <input type="text" value="<?php echo  $emailBuscado  ?>"name="Email" id="Email" class="pendiente"></input><br>
            <?php
                try{
                    $usuarioNivel=$usuario->sacarNivel($_SESSION["user"]);
                    if($usuarioNivel==2){
            ?>
            <label class="bloquear">Bloquear usuario<label>
                <br>
            <input type="text" class="bloquearusuario" name="bloquearUsuario"> </input>
            <br>
            <label class="bloquear">Nueva Contraseña<label>
                <br>
            <input type="text" class="bloquearTexto" name="bloquearTexto"> </input>
            <br>
            <input type="submit" class="buttonForm" name="submitBloquear" value="Bloquear"/>
            <br>
            <?php
                }
                    if(isset($_REQUEST['submitBloquear'])){
                        $admin=new Administrador();
                        $bloquearUsuaurio=$admin->modifyPassword($_REQUEST["bloquearTexto"],$_REQUEST   ["bloquearUsuario"]);
                        echo "entra";
                    }
                }catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../   logBD.txt");
                    // guardamos en ·errores el error que queremos mostrar a los usuarios
                    $erroresGuide['NoGuide'] = "Ha habido un error <br>";
                }
            ?>
            <input type="file" name="imagen" id="imagen"/>
            <br>
            <input type="submit" class="buttonForm" name="submitImage" value="Aceptar"/>
            <input type="button" id="Cancelar" name="Cancelar" value="Cancelar" onClick="perfil.php">
            <br>
           
            <input type="submit" class="buttonForm"class="buttonForm" name="CerrarSession" value="CerrarSession" >
            <?php
                if(isset($_REQUEST["CerrarSession"])){
                    session_destroy();
                    header("Location:../../HTML/Index.php");
                }
            ?>
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
<script>
    let cancelar=document.getElementById("Cancelar");

    cancelar.addEventListener('click',()=>{
        let cancelarV=document.querySelectorAll(".pendiente");
        console.log(cancelarV);
        cancelarV.forEach(nombre=>{
            console.log( document.getElementById(nombre.id).value);
            document.getElementById(nombre.id).value="";
        })
    })
</script>
</html>

<?php

    if (!isset($_REQUEST['submitImage'])) {


    } else {
        if (($_FILES['imagen']['error'] != 0)) {
            switch ($_FILES['imagen']['error']) {
                case 1:
                    $errores["imagen"] = "UPLOAD_ERR_INI_SIZE. Fichero demasiado grande";
                    break;
                case 2:
                    $errores["imagen"] = "UPLOAD_ERR_FORM_SIZE. El fichero es demasiado grande";
                    break;
                case 3:
                    $errores["imagen"] = "UPLOAD_ERR_PARTIAL. El fichero no se ha podido subir entero";
                    break;
                case 4:
                    $errores["imagen"] = "UPLOAD_ERR_NO_FILE. No se ha podido subir el fichero";
                    break;
                case 6:
                    $errores["imagen"] = "UPLOAD_ERR_NO_TMP_DIR. Falta carpeta temporal<br>";
                case 7:
                    $errores["imagen"] = "UPLOAD_ERR_CANT_WRITE. No se ha podido escribir en el disco<br>";

                default:
                    $errores["imagen"] = 'Error indeterminado.';
            }
        } else {
            $nombreArchivo = $_FILES['imagen']['name'];
            $directorioTemp = $_FILES['imagen']['tmp_name'];

            $tamanyoFile = filesize($directorioTemp);
            $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

            if (!in_array($extension, $extensionesValidas)) {
                $errores["imagen"] = "La extensión del archivo no es válida";
            }
            if ($tamanyoFile > $max_file_size) {
                $errores["imagen"] = "La imagen debe de tener un tamaño inferior a 50 kb";
            }

            if (empty($errores)) {
                $nombreArchivo = "image.png";
                if(is_file("../../img/".$usuarioBuscado."/".$nombreArchivo)){
                    unlink("../../img/".$usuarioBuscado."/image.png");
                }

                move_uploaded_file($directorioTemp, '../../img/'.$usuarioBuscado.'/'.$nombreArchivo);
            }
        }
try{

  $actualizar=$usuario->actualizainfo($_REQUEST["Nombre"],$_REQUEST["Email"],$usuarioBuscado);
 }catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                // guardamos en ·errores el error que queremos mostrar a los usuarios
                $erroresGuide['NoGuide'] = "Ha habido un error <br>";
            }
       

    }

    }
?>