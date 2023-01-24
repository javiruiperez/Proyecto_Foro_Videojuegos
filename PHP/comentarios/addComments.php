<?php
    /*ERROR, PÁGINA EN BLANCA AL DARLE AL BOTÓN DE ENVIAR (ARREGLAR)*/
    include("../libs/bGeneral.php");
    require("../modelo/classModelo.php");
    require("../modelo/classUsuario.php");
    require("../BaseDeDatos/config2.php");
    $errores = [];

    if(!isset($_REQUEST["submitComment"])){
        require("comments.php");
    } else{
        session_start();
        $userSession = $_SESSION["user"];
        $content = recoge("newComment");
        $idGame = rand(1, 100);

        if($content === ""){
            $errores["NoComment"] = "The comment cannot be blank";
        }

        if(count($errores) === 0){
            try{
                $usuario = new Usuario();
                if($userBD = $usuario->getIdUser($userSession)){ //Usuario base de datos forousuarios
                    //ERROR POR NO TENER ID DE JUEGO (AÑADIR CON FUNCIÓN DE FRAN)
                    if($commentBD = $usuario->guardarComentario($idGame, $content, $userBD)){ //añadir comentario
                        echo "comentario añadido";
                        header("location:../../HTML/index.html");
                    } else{
                        echo "comentario incorrecto";
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
                $errores['datos'] = "Ha habido un error <br>";
            }
        } else {
            require("comments.php");
        }
    }
?>