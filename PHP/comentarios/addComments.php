<?php
    include("../libs/bGeneral.php");
    require("../modelo/classModelo.php");
    require("../modelo/classUsuario.php");
    require("../BaseDeDatos/config.php");
    $erroresComment = [];
    $erroresGuide = [];

    session_start();
    if (!isset($_SESSION["user"])) {
        $erroresComment["NoSession"] = "true";
    }else{
        $userSession = $_SESSION["user"];
    }

    if(!isset($_REQUEST["submitComment"]) && !isset($_REQUEST["sendNewGuide"])){
        require("comments.php");
    } else{
        if(isset($_REQUEST["sendNewGuide"])){
            if(!isset($_SESSION["user"])){
                $phpVar1 = $_GET['w1'];
                $phpVar2 = $_GET['w2'];
                $phpVar3 = $_GET['w3'];
                header('Location:../login/checkLogin.php?w1='.$phpVar1.'&w2='.$phpVar2.'&w3='.$phpVar3);
                //If user is not logged in, redirect to the login page
            }else{
                $guideText = recoge("textNewGuide");
                $phpVar1 = $_GET['w1'];

                if($guideText === ""){
                    $errores["NoGuide"] = "Your guide cannot be blank";
                }

                if(count($erroresGuide) === 0){
                    try{
                        $guiaBD = new Usuario();
                        if($userId = $guiaBD->getIdUser($userSession))
                        if($guiaGurdar = $guiaBD->guardarGuia($phpVar1, $guideText, $userId)){
                            header("Refresh:0");
                        }

                    } catch(PDOException $e){
                        error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                        //Save errors
                        $erroresGuide['NoGuide'] = "Error <br>";
                    }
                }
            }
        }
        if(isset($_REQUEST["submitComment"])){
            if(!isset($_SESSION["user"])){
                $phpVar1 = $_GET['w1'];
                $phpVar2 = $_GET['w2'];
                $phpVar3 = $_GET['w3'];
                header('Location:../login/checkLogin.php?w1='.$phpVar1.'&w2='.$phpVar2.'&w3='.$phpVar3);
            }else{
                $content = recoge("newComment");
                $phpVar1 = $_GET['w1'];
                $phpVar2 = $_GET['w2'];
                $phpVar3 = $_GET['w3'];

                if($content === ""){
                    $erroresComment["NoComment"] = "Comment cannot be blank";
                }

                if(count($erroresComment) === 0){
                    try{
                        $usuario = new Usuario();
                        if($IDuser = $usuario->getIdUser($userSession)){ //User database
                            if($commentBD = $usuario->guardarComentario($phpVar1, $content, $IDuser)){ //Adds comment
                                $addComment = $usuario->sumarComentario($IDuser);
                                //The comment is saved to the database and the website is refreshed
                                header("Refresh:0");
                            }
                        }
                    
                    } catch(PDOException $e){
                        error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                        // guardamos en ·errores el error que queremos mostrar a los usuarios
                        $erroresComment['NoComment'] = "Error <br>";
                    }
                } else{
                    header('Location:addComments.php?w1='.$phpVar1.'&w2='.$phpVar2. '&w3='.$phpVar3);
                }
            }
        }
    }
?>