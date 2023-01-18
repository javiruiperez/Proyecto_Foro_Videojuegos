<?php
    include("../libs/bGeneral.php");
    require("../modelo/classModelo.php");
    require("../modelo/classUsuario.php");
    require("../BaseDeDatos/config.php");
    cabecera("Account Recovery");
    $errores = [];

    if(!isset($_REQUEST["submitForgot"])){
        require("forgotPass.php");
    } else{
        $email = recoge("emailForgot");

        if($email === ""){
            $errores["emailForgot"] = "Invalid email address";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores["emailForgot"] = "Invalid email address";
        }

        if(count($errores) === 0){
            try{
                $usuarioEmail = new Usuario();
                if($emailBD = $usuarioEmail->checkEmail($email)){
                    $newPass = randomPassword();
                    $passwordBD = $usuarioEmail->modifyPassword($newPass, $email);
                    sendMail($email, $newPass);
                    header("location:checkLogin.php");
                } else{
                    $errores["emailForgot"] = "The email does not exist";
                    require("forgotPass.php");
                }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errores['datos'] = "Ha habido un error <br>";
            }
            
        } else{
            require("forgotPass.php");
        }
    }
?>