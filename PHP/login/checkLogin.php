<?php
    include("../libs/bGeneral.php");
    require("../modelo/classModelo.php");
    require("../modelo/classUsuario.php");
    require("../BaseDeDatos/config.php");
    cabecera("Log In");
    $errores = [];
    
    /*THIS CHECKS IF A SESSION IS STARTED AND REDIRECTS TO TH MAIN PAGE IF IT DOES
    session_start();
    if($_SESSION["user"] != ""){
        header("location:../../HTML/index.html");
    }*/

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
            try{
                    $usuario = new Usuario();
                    if($userBD=$usuario->checkPassword($user, $password)){
                        session_start();
                        $_SESSION["user"] = $user;
                       
                        header("location:../../HTML/index.php"); //Change url config so the user profile picture appears  at the top-right corner of the screen
                    } else{
                        $errores["NoUserLogin"] = "The email or password is incorrect";
                        require("formLogin.php");
                        $logeado=false;
                        echo json_encode($logeado); 
                    }
            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                // guardamos en ·errores el error que queremos mostrar a los usuarios
                $errores['datos'] = "Ha habido un error <br>";
            }
        } else{
            require("formLogin.php");
           
        }

      
    }