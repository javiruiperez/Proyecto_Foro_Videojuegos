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

        if(count($errores) === 0){
            $selectUser = "SELECT * FROM users WHERE username = $user AND passwrd = $password";
            $selcthola = 2;
            if($selectUser === 0 || $selectUser === null){ //This should check if the username and password exists and if it doesn't, it will show an error
                $errores["NoUserLogin"] = "The email or password is incorrect";
            } else{
                session_start();
                $_SESSION["user"] = $user;
                header("location:home.html"); //Change url config so the user profile picture appears at the top-right corner of the screen
            }
        } else{
            require("formLogin.php");
        }
    }