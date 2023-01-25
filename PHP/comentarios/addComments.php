<?php
    /*ERROR, PÁGINA EN BLANCA AL DARLE AL BOTÓN DE ENVIAR (ARREGLAR)*/
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
        $idGame = rand(1, 100);
        
        if($content === ""){
            $errores["NoComment"] = "Comment cannot be blank";
        }
        
        if(count($errores) === 0){
            try{
                echo $idGame;
                $usuario = new Usuario();
                if($userBD=$usuario->getIdUser($userSession)){ //Usuario base de datos forousuarios
                    if($commentBD = $usuario->guardarComentario($idGame, $content, $userBD)){
                        //NO ENTRA AQUÍ
                        echo "comentario añadido";
                        header("location:../../HTML/index.html");
                    } else{
                        $errores["NoComment"] = "Error with the comment";
                        require("comments.php");
                    }
                } else{
                    //BORRAR LUEGO CUANDO YA ESTÉ RESUELTO
                    echo "usuario no añadido".$userBD;
                    require("comments.php");
                }

            } catch(PDOException $e){
                error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                // guardamos en ·errores el error que queremos mostrar a los usuarios
                $errores['NoComment'] = "Ha habido un error <br>";
            }
        } else {
            require("comments.php");
        }
    }
?>