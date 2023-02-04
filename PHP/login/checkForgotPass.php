<?php
    include("../libs/bGeneral.php");
    require("../modelo/classModelo.php");
    require("../modelo/classUsuario.php");
    require("../BaseDeDatos/config.php");
    // require("../register/enviar.php");
    $errors = [];
 
    if(!isset($_REQUEST["submitForgot"])){
        require("forgotPass.php");
    } else{
        $email = recoge("emailForgot");
       

        if($email === ""){
            $errors["emailForgot"] = "Invalid email address";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["emailForgot"] = "Invalid email address";
        }

        if(count($errors) === 0){
            try{
                //it create a new password that it send in the email and in the BD the password is change a new 
                $usuarioEmail = new Usuario();
                if($emailBD = $usuarioEmail->checkEmail($email)){
                   
                    header("location:../correos/enviar.php?variable1=$email");
                
                   
                } else{
                    $errors["emailForgot"] = "The email does not exist";
                    require("forgotPass.php");
                }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                $errors['datos'] = "Error <br>";
            }
            
        } else{
            require("forgotPass.php");
        }
    }
?>