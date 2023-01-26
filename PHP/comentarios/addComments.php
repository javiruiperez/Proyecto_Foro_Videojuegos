<?php
    // CAMBIAR CÓDIGO = PRIMERO MOSTRARÁ LOS COMENTARIOS YA EXISTENTES Y LUEGO AÑADIRÁ
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

        if (isset($_GET["w1"])) {
            $phpVar1 = $_GET['w1'];
        }
        try{
            $comentarios = new Usuario();
            $commentsArray = $comentarios->sacarComentariosOrdenPorJuego($phpVar1);
            echo $commentsArray;
        } catch(PDOException $e){
            error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
            // guardamos en ·errores el error que queremos mostrar a los usuarios
            $errores['NoComment'] = "Ha habido un error <br>";
        }
        
        if($content === ""){
            $errores["NoComment"] = "<div class='errorMessage'>Comment cannot be blank</div>";
        }
        require("comments.php");
        
        if(count($errores) === 0){
            try{
                $usuario = new Usuario();
                if($userBD = $usuario->getIdUser($userSession)){ //Usuario base de datos forousuarios
                    if($commentBD = $usuario->guardarComentario($phpVar1, $content, $userBD)){ //añadir comentario

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