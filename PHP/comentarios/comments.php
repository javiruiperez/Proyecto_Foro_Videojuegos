<?php
    include("../perfil/rangos.php");
?>

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
    <div class="allContent">
        <div class="headerImage">
            <picture class="parallax">
                <div class="header-top-gradient"></div>
                <img src='<?php echo $_GET["w2"]; ?>' alt="Game Banner">
            </picture>
        </div>
        <header>
            <nav>
                <div class="grid-container">
                    <div class="col-1"><a href="../../HTML/Index.php">
                            <h1 class="titulo">ForoGamers</h1>
                        </a></div>
                    <div class="col-2">
                        <form action="">
                            <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
                        </form>
                    </div>
                    <div class="col-3">
                        <?php
                            if (isset($_SESSION["user"])) {
                                echo '<div class="col-3"><a href="../perfil/perfil.php" class="profilePicture usuario"><img src="../../img/' . $_SESSION["user"] . '/image.png"></a></div>';
                            } else {
                                echo '<div class="col-3"><a href="../register/registro.php" class="sign-In">Sign up</a><a href="../login/checkLogin.php" class="log-In">Log in</a></div>';
                            }
                        ?>
                    </div>
                </div>
            </nav>
        </header>
        <div class="guideInformation">
            <div id="borrar">
                <div class="guide">
                    <div class="imageGuide">
                        <?php
                        //Image of the game is put into the guide div
                        if (isset($_GET["w2"])) {
                            $phpVar2 = $_GET["w2"];
                            echo "<img src=" . $phpVar2 . " width=300px/>";
                        } else {
                            header("Location:../../HTML/Index.php");
                        }
                        ?>
                    </div>
                    <div class="newGuide">
                        <?php
                        try {
                            $guia = new Usuario();
                            $issetGuide = false;
                            $phpVar1 = $_GET['w1'];
                            if ($guideGame = $guia->sacarGuiaPorJuego($phpVar1)) {
                                $issetGuide = true;
                                echo "<div class=guiaJuego>" . $guideGame . "</div>";
                            } else {
                        ?>
                                <form action="" method="post">
                                    <input type="text" id='inputGuide' placeholder="Add a new guide..." name="textNewGuide" />
<<<<<<< HEAD
                                    <input type="submit" value="Post" name="sendNewGuide" />
=======
                                    <input type="submit" value="Post" name="sendNewGuide" class="buttonGuide"/>
>>>>>>> 6366b6394701698c1fbef437a7c9a6962d8dabfc
                                </form>
                        <?php
                            }
                        } catch (PDOException $e) {
                            error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() .    PHP_EOL, 3,    "../   logBD.txt");
                            // guardamos en ·errores el error que queremos mostrar a los usuarios
                            $erroresComment['NoComment'] = "Ha habido un error <br>";
                        }
                        ?>
                    </div>
                </div>
                <?php
                if (isset($_GET["w2"])) {
                    $phpVar2 = $_GET['w2'];
                } else {
                    header("Location:../../HTML/Index.php");
                }
                ?>
                <div class="userInfo">
                    <?php
                    if ($issetGuide) {
                    ?>
                        <form action="" method="post">
                            <?php
                            if (!isset($_SESSION["user"])) {
                                echo '<div class="pfp"><img src="../../img/image.png"></div>';
                            } else {
                                echo '<div class="pfp"><img src=../../img/' . $_SESSION["user"] . '/image.png></div>';
                            }
                            ?>
                            <input type="text" id="newComment" placeholder="Add a comment..." name="newComment" maxlength="300" />
                            <?php
<<<<<<< HEAD
                            echo (isset($erroresComment["NoComment"])) ? "<div  class='errorMessage'>$erroresComment     [NoComment]</div>" : "";
                            ?>
                            <input type="submit" value="Comment" name="submitComment" id="buttonComment" />
=======
                                echo (isset($erroresComment["NoComment"])) ? "<div class='errorMessage'>$erroresComment[NoComment]</div>" : "";
                            ?>
                            <input type="submit" value="Comment" name="submitComment" class="buttonComment"/>
>>>>>>> 6366b6394701698c1fbef437a7c9a6962d8dabfc
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
                    } else {
                        header("Location:../../HTML/Index.php");
                    }
                    try {
                        $comentarios = new Usuario();
                        $commentsArray = $comentarios->sacarComentariosOrdenPorJuego($phpVar1);
                        $numero = 0;
                        foreach ($commentsArray as $comment) {
                            $numeroComentarios = $comentarios->numeroComentarios($_SESSION["user"]);
                            $userId = $comment["idUsuario"];
                            $userComment = $comentarios->getUsername($userId);
                            while ($numeroComentarios > $ranges[$numero]) {
                                $numero++;
                                $ranges[$numero];
                            }
                            if ($numeroComentarios < $ranges[$numero]) {


                                echo '<div class="commentContainer">';
                                echo '<div class="profilePicture"><img src=../../img/' . $userComment . '/image.png></div>';
                                echo '<div class="textComment">';
                                echo '<div class=userComment id="colortexto' . $numero . '">' . $userComment . '</div>';
                                echo '<div class=comment>' . $comment["texto"] . '</div>';
                                echo '<div class="dateComment">' . $comment["fecha"] . '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                    } catch (PDOException $e) {
                        error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "../logBD.txt");
                        // guardamos en ·errores el error que queremos mostrar a los usuarios
                        $erroresComment['NoComment'] = "Error <br>";
                    }
                    ?>
                </div>
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
    </div>
</body>
<script src="../../JS/generos2.js"></script>
</html>