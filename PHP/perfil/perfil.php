<?php
require("../modelo/classModelo.php");
require("../modelo/classUsuario.php");
require("../BaseDeDatos/config.php");
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
                <div class="col-3"><a href="../register/registro.php" class="sign-In">Sign up</a><a href="../login/checkLogin.php" class="log-In">Log in</a></div>
            </div>
          
        </nav>
    </header>
    <div class="form">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="box"><img src=
        <?php
            echo "../../img/".$usuarioBuscado."/image.png"; 
        ?>></div>
            <label>Nombre</label><br>
            <label><?php echo  $nombreBuscado  ?></label><br>
            <label>User</label><br>
            <label><?php echo  $usuarioBuscado  ?></label><br>
            <label>Email</label><br>
            <label><?php echo  $emailBuscado  ?></label><br>
            <input type="file" name="imagen" id="imagen"/>
            <br>
            <input type="submit" class="buttonForm" name="submitImage" value="Aceptar"/>
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
    }

    }else{
        header("Location:../../HTML/Index.php");
    }
?>