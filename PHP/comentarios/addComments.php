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
                header('Location:../login/checkLogin.php?w1='.$phpVar1.'&w2='.$phpVar2);
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
                        // save errors
                        $erroresGuide['NoGuide'] = "Error <br>";
                    }
                }
            }
        }
// we send name of game and link of image if you arent login 
        if(isset($_REQUEST["submitComment"])){
            if(!isset($_SESSION["user"])){
                $phpVar1 = $_GET['w1'];
                $phpVar2 = $_GET['w2'];
                header('Location:../login/checkLogin.php?w1='.$phpVar1.'&w2='.$phpVar2);
            }
            $content = recoge("newComment");
            $phpVar1 = $_GET['w1'];
            $phpVar2 = $_GET['w2'];

            if($content === ""){
                $erroresComment["NoComment"] = "Comment cannot be blank";
            }

            if(count($erroresComment) === 0){
                try{
                    $usuario = new Usuario();
                    if($IDuser = $usuario->getIdUser($userSession)){ //Usuario base de datos forousuarios
                        if($commentBD = $usuario->guardarComentario($phpVar1, $content, $IDuser)){ //añadir comentario
                            $addComment = $usuario->sumarComentario($IDuser);
                            //the new comment to see when the user finish write the comment
                            header("Refresh:0");
                        }
                    }
                
                } catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                    // guardamos en ·errores el error que queremos mostrar a los usuarios
                    $erroresComment['NoComment'] = "Error <br>";
                }
            } else{
                header('Location:addComments.php?w1='.$phpVar1.'&w2='.$phpVar2);
            }
        }
    }
?>