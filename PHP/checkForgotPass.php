<?php
    include("../libs/bGeneral.php");
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
            echo "correcto";
            
        } else{
            require("forgotPass.php");
        }
    }
?>