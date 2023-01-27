<?php
    // SI NO TIENE GUÍA, NO PUEDES COMENTAR (IMPORTANTE = CAMBIAR)
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
            $guideText = recoge("textNewGuide");

            if (isset($_GET["w1"])) {
                $phpVar1 = $_GET['w1'];
            }

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
                    // guardamos en ·errores el error que queremos mostrar a los usuarios
                    $erroresGuide['NoGuide'] = "Ha habido un error <br>";
                }
            }
        }

        if(isset($_REQUEST["submitComment"])){
            $content = recoge("newComment");
            
            if (isset($_GET["w1"])) {
                $phpVar1 = $_GET['w1'];
            }

            if($content === ""){
                $erroresComment["NoComment"] = "<div class='errorMessage'>Comment cannot be blank</div>";
            }

            if(count($erroresComment) === 0){
                try{
                    $usuario = new Usuario();
                    if($userBD = $usuario->getIdUser($userSession)){ //Usuario base de datos forousuarios
                        if($commentBD = $usuario->guardarComentario($phpVar1, $content, $userBD)){ //añadir comentario
                            header("Refresh:0");
                        }
                    }
                
                } catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                    // guardamos en ·errores el error que queremos mostrar a los usuarios
                    $erroresComment['NoComment'] = "Ha habido un error <br>";
                }
            }
        }
    }
?>