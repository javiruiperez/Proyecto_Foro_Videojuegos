<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&family=VT323&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/Index.css">
    <link rel="stylesheet" href="../../CSS/comments.css">
    <title>ForoGamers</title>
</head>
<body>
    <header>
        <nav>
            <div class="grid-container">
                <div class="col-1"><a href="../../HTML/Index.php"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="col-2">
                <form action="">                
                  <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
              </form></div>
                <div class="col-3"><a href="../register/registro.php" class="sign-In">Sign up</a><a href="../login/checkLogin.php" class="log-In">Log in</a></div>
            </div>
        </nav>
    </header>

    <div id="borrar">
        <div class="guide">
            <?php
                try{
                    $guia = new Usuario();
                    $issetGuide = false;
                    $phpVar1 = $_GET['w1'];
                    if($guideGame = $guia->sacarGuiaPorJuego($phpVar1)){
                        $issetGuide = true;
                        echo "<div class=guiaJuego>".$guideGame."</div>";
                    } else{
                        ?>
                        <div class="newGuide">
                            <form action="" method="post">
                                <input type="text" id='inputGuide' placeholder="Add a new guide..." name="textNewGuide"/>
                                <input type="submit" value="Post" name="sendNewGuide"/>
                            </form>
                        </div>
                        <?php
                    }
                } catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                        // save errors
                        $erroresComment['NoComment'] = "Ha habido un error <br>";
                }
            ?>
            <div class="userGuideInfo">
                <div id="imageGuide">
                <?php
                    //Image of the game is put into the guide div
                    if(isset($_GET["w2"])){
                        $phpVar2 = $_GET["w2"];
                        echo "<img src=".$phpVar2." width=300px/>";
                    } else{
                        header("Location:../../HTML/Index.php");
                    }
                ?>
                </div>
            </div>
        </div>
        <?php
            if (isset($_GET["w2"])) {
                $phpVar1 = $_GET['w2'];
            } 
            else{
                header("Location:../../HTML/Index.php");
            }
        ?>
        <div class=`<?php echo (isset($erroresComment["NoSession"])) ? "noSession": "createComments" ?>`>
            <div class="userInfo">
                <div id="imageUser"></div>
                <div id="nameUser"></div>
            </div>
            <?php
                if($issetGuide){
            ?>
                <form action="" method="post">
                    <input type="text" id="newComment" placeholder="Add a comment..." name="newComment" maxlength="300"/>
                    <?php
                        echo (isset($erroresComment["NoComment"])) ? "<div class='errorMessage'>$erroresComment [NoComment]</div><br>": "";
                    ?>
                    <input type="submit" value="Send" name="submitComment" id="buttonComment"/>
                </form>
            <?php
            }
            ?>
        </div>

        <div id="readComments">
            <?php
                if (isset($_GET["w1"])) {
                    $phpVar1 = $_GET['w1'];
                    $phpVar2 = $_GET['w2'];
                } 
                else{
                    header("Location:../../HTML/Index.php");
                }
                try{
                    $comentarios = new Usuario();
                    $commentsArray = $comentarios->sacarComentariosOrdenPorJuego($phpVar1);
                  
                    foreach($commentsArray as $comment){
                       $numeroComentarios= $comentarios->numeroComentarios($comment["idUsuario"]);
                       $userId = $comment["idUsuario"];
                       $userComment = $comentarios->getUsername($userId);
                        if($numeroComentarios>=5){
                            echo '<div class=divComment>';
                                echo '<div class=profilePicture>';
                                    echo '<img src=../../img/'.$userComment.'/image.png>';
                                echo '</div>';
                                echo '<div class=guideContent>';
                                    echo '<div class=userComment>'.$userComment.'</div>';
                                    echo '<div class=comment>'. $comment["texto"].'</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        else{
                            echo '<div class=divComment>';
                                echo '<div class=profilePicture>';
                                    echo '<img src=../../img/'.$userComment.'/image.png>';
                                echo '</div>';
                                echo '<div class=guideContent>';
                                    echo '<div class=userComment>'.$userComment.'</div>';
                                    echo '<div class=commentSin>'. $comment["texto"].'</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    
                } catch(PDOException $e){
                    error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                    // guardamos en ·errores el error que queremos mostrar a los usuarios
                    $erroresComment['NoComment'] = "Error <br>";
                }
            ?>
        </div>
    </div>
    <div id="Images"></div>

    <footer>
        <div class="footer">
            <div class="row">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our services</a></li>
                    <li><a href="#" download>Privacy politics</a></li>
                    <li><a href="#" download>Terms and conditions</a></li>
                </ul>
            </div>
            <div class="row">
                ForoGamers Copyright © 2023 FG - All rights reserved || Designed By: Javier Ruiperez, Fran Botella, Oscar Delicado
            </div>
        </div>
    </footer>
</body>
<script src="../../JS/generos2.js"></script>
</html>