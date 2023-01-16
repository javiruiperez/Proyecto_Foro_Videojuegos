<?php
    include("../libs/bGeneral.php");
    cabecera("Log In");
    $errores = [];

    if(!isset($_REQUEST["submitLogin"])){
        require("formLogin.php");
    } else{
        $user = recoge("usernameLogin");
        $password = recoge("passwordLogin");

        if($user === ""){
            $errores["NoUserLogin"] = "Username cannot be empty";
        }

        if($password === ""){
            $errores["NoPassLogin"] = "Password cannot be empty";
        }

        if(count($errores) === 0){//This should check if the username and password exists and if it doesn't, it will show an error
            $cryptPassword = "SELECT contraseñaEncriptada FROM usuarios WHERE usuario = '$user'"; 
            $checkPass = crypt($password, $cryptPassword);
            if($checkPass == $cryptPassword){
                session_start();
                $_SESSION["user"] = $user;
                header("location:home.html"); //Change url config so the user profile picture appears at the top-right corner of the screen
            } else{
                $errores["NoUserLogin"] = "The email or password is incorrect";
                require("formLogin.php");
            }
        } else{
            require("formLogin.php");
        }
    }