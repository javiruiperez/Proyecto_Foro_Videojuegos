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


  // session_start();
    // if (isset($_SESSION["user"])) {
    //     echo "holaxd";
    //     header("location:../../HTML/Index.php");
    // }

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
    <body>
        <?php
            cabecera();
        ?>
        <div class="form">
            <form name="register" method="post" action="" enctype="multipart/form-data">
                <?php
                foreach ($datesform as $campo => $valor) {
                    if ($campo != "Password") {
                ?>
                        <label><?php echo  $campo ?></label><br>
                        <input type="text" name="<?php echo $campo ?>" ></input>
                        <br>
                    <?php
                    } else {
                    ?>
                        <label><?php echo  $campo ?></label><br>
                        <input type="password" name="<?php echo $campo ?>"></input>
                        <br>
                <?php
                    }
                };
                ?><br>
                <input TYPE="submit" name="bAcept" VALUE="Sign up" class="buttonForm">
                <div class="messageLogin">Already have an account? <a href="../login/checkLogin.php">Log in</a></div>
            </form>
        </div>
        <?php
            pie();
        ?>
    </body>
    </html>

<?php
} else {
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
        $passwordBD = crypt_blowfish($datesform[PASSWD]);
        $datesform[PASSWD] = $passwordBD;
    } else {
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
    <body>
    <?php
        cabecera();
    ?>
        <div class="form">
            <form name="register" method="post" action="" enctype="multipart/form-data">
                <?php
                foreach ($datesform as $campo => $valor) {
                    if ($campo != "Password") {
                ?>
                        <label><?php echo  $campo ?></label><br>
                        <input type="text" name="<?php echo $campo ?>" value="<?php echo $valor ?>"></input>
                        <?php
                            echo $erroresMsg[$campo];
                        ?>
                        <br>
                    <?php
                    } else {
                    ?>
                        <label><?php echo  $campo ?></label><br>
                        <input type="password" name="<?php echo $campo ?>" value="<?php echo $valor ?>"></input>
                        <?php
                            echo $erroresMsg[$campo];
                        ?>
                        <br>
                <?php
                    }
                };
                ?> <br>
                <input TYPE="submit" name="bAcept" VALUE="Sign up" class="buttonForm"><br>
                <div class="messageLogin">Already have an account? <a href="../login/checkLogin.php">Log in</a></div>
            </form>
        </div>
    </body>
    </html>

<?php
    $verificacionDef = true;

    foreach ($datesform as $campo => $valor) {
        if ($valor != "" && $verificacionDef != false) {
            $verificacionDef = true;
        } else {
            $verificacionDef = false;
        }
    }


    if ($verificacionDef == true) {
        $_SESSION['Name'] = $datesform[USER];

        try {
            $usuario = new Usuario();
            $usuarioBuscado = $usuario->getUser($datesform[USER]);

            if ($usuarioBuscado != $datesform[USER]) {
                $userInto = $usuario->insertUser($datesform[NAME], $datesform[USER], $datesform[PASSWD], $datesform[EMAIL]);
                mkdir("../../img/".$datesform[USER]);
                copy("../../img/image.png", "../../img/".$datesform[USER]."/image.png");
                pie();
                header("location:../../HTML/Index.php");
                // header("location:enviar.php");
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
