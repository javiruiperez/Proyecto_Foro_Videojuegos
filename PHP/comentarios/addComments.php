<?php
    include("../libs/bGeneral.php");
    require("../modelo/classModelo.php");
    require("../modelo/classUsuario.php");
    require("../BaseDeDatos/config.php");
    $errores = [];

    if(!isset($_REQUEST["submitComment"])){
        require("comments.php");
      
    } else{
        session_start();
        $userSession = $_SESSION["user"];
        $content = recoge("newComment");
     
        require("comments.php");
        if($content === ""){
            $errores["NoComment"] = "Comment cannot be blank";
        }
        
        if(count($errores) === 0){
            try{
                if (isset($_GET["w1"])) {
                    $phpVar1 = $_GET['w1'];
                }
                $usuario = new Usuario();
                if($userBD = $usuario->getIdUser($userSession)){ //Usuario base de datos forousuarios
                    if($commentBD = $usuario->guardarComentario($phpVar1, $content, $userBD)){ //añadir comentario
                        // header("location:../../HTML/index.html");
                    } else{
                        $errores["NoComment"] = "Error with the comment";
                        require("comments.php");
                    }
                }

            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                // guardamos en ·errores el error que queremos mostrar a los usuarios
                $errores['NoComment'] = "Ha habido un error <br>";
            }
        }
    }
?>