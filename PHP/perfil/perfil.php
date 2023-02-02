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
        $user = new Usuario();

        $userGet = $user->getUser($_SESSION["user"]);
        $emailGet= $user->getEmail($_SESSION["user"]);
        $nameGet=$user->getNombre($_SESSION["user"]);

    } catch(PDOException $e){
        error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
        // save errors
        $errorsGuide['NoGuide'] = "Ha habido un error <br>";
    }

    $nameFile = "";
    $dir = "../../img";
    $max_file_size = "51200000";
    $extensions= array(
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
    <link rel="stylesheet" href="../../CSS/perfil.css">
    <title>ForoGamers</title>
</head>
<body class="body">
    <header>
        <nav>
            <div class="grid-container">
                <div class="col-1"><a href="../../HTML/Index.php"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="col-2">
                <form action="">                
                  <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
              </form></div>
              <div class="col-3"><a href="perfil.php" class="sign-In">User</a></div>
            </div>
          
        </nav>
    </header>
        <form id="perfilForm" action="" method="post" enctype="multipart/form-data">
            <div class="box"><img src=
            <?php
                echo "../../img/".$userGet."/image.png"; 
            ?>></div>
            <label>Name :</label><br>
            <div class="user-box">
            <input type="text" value="<?php echo $nameGet?>" name="Name" id="Nombre" class="slope"></label><br>
            </div>
            <br>
            <label>User :</label><br>
            <label><?php echo $userGet?></label><br>
            <label>Email :</label><br>
            <div class="user-box">
            <input type="text" value="<?php echo  $emailGet  ?>"name="Email" id="Email" class="slope"></input><br>
            </div>
            <br>
           <?php
                try{
                    $userLevel=$user->getLevel($_SESSION["user"]);
                    //If you are level 2 ,you are admin
                    if($userLevel==2){
            ?>
            <label class="bloquear">Block user :</label>
                <br>
                <div class="user-box">
            <input type="text" class="blockUser" name="blockUser"> </input>
                    </div>
            <br>
            <label class="bloquear">New password :</label>
                <br>
                <div class="user-box">
            <input type="text" class="blockText" name="blockText"> </input>
                    </div>
            <br>
            <input type="submit" class="buttonForm" name="submitBlock" value="Block"/>
            <br>
            <?php
                }
                    if(isset($_REQUEST['submitBlock'])){
                        $admin=new Administrador();
                        $bloquearUsuaurio=$admin->modifyPassword($_REQUEST["blockText"],$_REQUEST   ["blockUser"]);
                      
                    }
                }catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../   logBD.txt");
                    // Save errors of user
                    $errorsGuide['NoGuide'] = "Error <br>";
                }
            ?>
             <label>Change image of profile :</label><br>
            <input type="file" name="imagen" id="imagen"/>
            <br>
            <div id="Botones">
            <input type="submit" class="buttonForm" name="submitImage" value="Acept"/>
            <input type="button" id="Cancel" class="buttonForm" name="Cancel" value="Cancel" onClick="perfil.php"/>
            </div>
            <br>
           
            <input type="submit" class="buttonForm"class="buttonForm" name="SignOff" value="Sign off" />
            <br>
            <?php
                if(isset($_REQUEST["SignOff"])){
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
    //restore values of inputs to nothing =""
    let cancel=document.getElementById("Cancel");

    cancel.addEventListener('click',()=>{
        let cancelV=document.querySelectorAll(".slope");
        cancelV.forEach(name=>{
            document.getElementById(name.id).value="";
        })
    });
</script>
</html>

<?php

    if (isset($_REQUEST['submitImage'])) {
        if (($_FILES['imagen']['error'] != 0)) {
            switch ($_FILES['imagen']['error']) {
                case 1:
                    $errors["imagen"] = "UPLOAD_ERR_INI_SIZE. File very big";
                    break;
                case 2:
                    $errors["imagen"] = "UPLOAD_ERR_FORM_SIZE. File very big";
                    break;
                case 3:
                    $errors["imagen"] = "UPLOAD_ERR_PARTIAL. File update is interrumpt ";
                    break;
                case 4:
                    $errors["imagen"] = "UPLOAD_ERR_NO_FILE. File is not update";
                    break;
                case 6:
                    $errors["imagen"] = "UPLOAD_ERR_NO_TMP_DIR. Without temporal folder <br>";
                case 7:
                    $errors["imagen"] = "UPLOAD_ERR_CANT_WRITE. Not to write in the disk<br>";

                default:
                    $errors["imagen"] = 'Error undefined.';
            }
        } else {
            $nameFile = $_FILES['imagen']['name'];
            $directorioTemp = $_FILES['imagen']['tmp_name'];

            $tamanyoFile = filesize($directorioTemp);
            $extension = strtolower(pathinfo($nameFile, PATHINFO_EXTENSION));

            if (!in_array($extension, $extensions)) {
                $errors["imagen"] = "The extension is not valid";
            }
            if ($tamanyoFile > $max_file_size) {
                $errors["imagen"] = "The image is more ".$max_file_size;
            }

            if (empty($errors)) {
                //change img profile in this page
                $nameFile = "image.png";
                if(is_file("../../img/".$userGet."/".$nameFile)){
                    unlink("../../img/".$userGet."/image.png");
                }

                move_uploaded_file($directorioTemp, '../../img/'.$userGet.'/'.$nameFile);
            }
        }
try{
    //if email and name are true in the base is update
    $checkEmail=false;
    $checkName=false;
    if (preg_match("#[\w\._]{3,}@\w{5,}\.+[\w]{2,}#i", $_REQUEST["Email"]) == 1) {
       $checkEmail=true;
    }
    if (preg_match("#^[a-zZ-a]#i", $_REQUEST["Name"]) == 1) {
       $checkName=true;
    } 
    if($checkEmail==true&&$checkName==true){
  $update=$user->actualizainfo($_REQUEST["Name"],$_REQUEST["Email"],$userGet);
    }

    
 }catch(PDOException $e){
                error_log($e->getMessage() . "##Code: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                // save errors
                $errorsGuide['NoGuide'] = "Error <br>";
            }
        }
    }

?>