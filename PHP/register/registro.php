<?php
include("./arrays.php");
include("./encriptarContraseñas.php");
require("../modelo/classModelo.php");
require("../modelo/classUsuario.php");
require("../BaseDeDatos/config.php");
include("../libs/bGeneral.php");
$datesform = array(
    NAME => "",
    USER => "",
    PASSWD => "",
    EMAIL => ""
);
$erroresMsg = array(
    NAME => "",
    USER => "",
    PASSWD => "",
    EMAIL => ""
);

$passwordWithout="";
 

if (!isset($_REQUEST['bAcept'])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&family=VT323&display=swap" rel="stylesheet">
        <title>Register</title>
        <link rel="stylesheet" href="../../CSS/Registro.css">
        <link rel="stylesheet" href="../../CSS/Index.css">
    </head>
    <body class="body">
        <?php
            cabecera();
        ?>
        <div class="form">
        <div class="register-box">
            <form name="register" method="post" action="" enctype="multipart/form-data">
                <?php
                foreach ($datesform as $campo => $valor) {
                    if ($campo != "Password") {
                ?>
                        <div class="user-box">
                        <label><?php echo  $campo ?></label><br>
                        <input type="text" name="<?php echo $campo ?>" ></input>
                        <br>
                        </div>


                    <?php
                    } else {
                    ?>
                        <div class="user-box">
                        <label><?php echo  $campo ?></label><br>
                        <input type="password" name="<?php echo $campo ?>"></input>
                        <br>
                        </div>
                <?php
                    }
                };
                ?>
                <input TYPE="submit" name="bAcept" VALUE="Sign up" class="buttonForm">
                <div class="messageLogin">Already have an account? <a href="../login/checkLogin.php">Log in</a></div>
            </form>
        </div>
        </div>
        <?php
            pie();
        ?>
    </body>
    </html>

<?php
} else {
    //check variables 
    if (preg_match("#^[a-zZ-a]#i", $_REQUEST["Name"]) == 1) {
        $datesform[NAME] = $_REQUEST["Name"];
    } else {
        $erroresMsg[NAME] = "<div class='errorMessage'>Not a valid name.</div";
    }
    if (preg_match("#\w#i", $_REQUEST["Username"]) == 1) {
        $datesform[USER] = $_REQUEST["Username"];
    } else {
        $erroresMsg[USER] = "<div class='errorMessage'>Not a valid username.</div";
    }
    if (preg_match("#\w#i", $_REQUEST["Password"]) == 1) {
        $datesform[PASSWD] = $_REQUEST["Password"];
      $passwordWithout=$_REQUEST["Password"];
      //crypt the password
        $passwordBD = crypt_blowfish($datesform[PASSWD]);
        $datesform[PASSWD] = $passwordBD;
    } else {
        $passwordWithout=$_REQUEST["Password"];
        $erroresMsg[PASSWD] = "<div class='errorMessage'>The password is not strong.</div";
    }
    if (preg_match("#[\w\._]{3,}@\w{5,}\.+[\w]{2,}#i", $_REQUEST["Email"]) == 1) {
        $datesform[EMAIL] = $_REQUEST["Email"];
    } else {
        $erroresMsg[EMAIL] = "<div class='errorMessage'>Not a valid email address.</div";
    }
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&family=VT323&display=swap" rel="stylesheet">
        <title>Register</title>
        <link rel="stylesheet" href="../../CSS/Registro.css">
        <link rel="stylesheet" href="../../CSS/Index.css">
    </head>
    <body class="body">
    <?php
        cabecera();
    ?>
        <div class="form">
        <div class="register-box">
            <form name="register" method="post" action="" enctype="multipart/form-data">
                <?php
                foreach ($datesform as $campo => $valor) {
                    if ($campo != "Password") {
                ?>
                        <div class="user-box">
                        <label><?php echo  $campo ?></label>
                        <input type="text" name="<?php echo $campo ?>" value="<?php echo $valor ?>"></input>
                        <?php
                            echo $erroresMsg[$campo];
                        ?>
                        <br>
                        </div>


                    <?php
                    } else {
                    ?>
                        <div class="user-box">
                        <label><?php echo  $campo ?></label>
                        <input type="password" name="<?php echo $campo ?>" value="<?php echo  $passwordWithout; ?>"></input>
                        <?php
                            echo $erroresMsg[$campo];
                        ?>
                        <br>
                        </div>
                <?php
                    }
                };
                ?> <br>
                <input TYPE="submit" name="bAcept" VALUE="Sign up" class="buttonForm"><br>
                <div class="messageLogin">Already have an account? <a href="../login/checkLogin.php">Log in</a></div>
            </form>
        </div>
        </div>
    </body>
    </html>

<?php
    $check = true;

    foreach ($datesform as $campo => $valor) {
        if ($valor != "" && $check != false) {
            $check = true;
        } else {
            $check = false;
        }
    }


    if ($check == true) {
        $_SESSION['Name'] = $datesform[USER];

        try {
            //create a folder with name of user and it has a image predifined
            $user = new Usuario();
            $userGet = $user->getUser($datesform[USER]);

            if ($userget != $datesform[USER]) {
                $userInto = $user->insertUser($datesform[NAME], $datesform[USER], $datesform[PASSWD], $datesform[EMAIL]);
                mkdir("../../img/".$datesform[USER]);
                copy("../../img/image.png", "../../img/".$datesform[USER]."/image.png");
                pie();
                header("location:../../HTML/Index.php");
               
            } else {
                $erroresMsg[EMAIL] = "<div class='errorRegister'>User already registered.</div>";
                echo $erroresMsg[EMAIL];
                pie();
            }
        } catch (PDOException $e) {
            // En este caso guardamos los errores en un archivo de errores log
            error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "./logBD.txt");
            // guardamos en ·errores el error que queremos mostrar a los usuarios
            $errores['datos'] = "Ha habido un error <br>";
        }
    }
}

?>
