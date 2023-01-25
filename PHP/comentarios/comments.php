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
    <script src="/JS/Busqueda_menu.js"></script>
    <title>Pagina de Inicio</title>
</head>
<body>
    <header>
        <nav>
            <div class="grid-container">
                <div class="grid-item-left"><a href="../../HTML/Index.html"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="grid-item-center">
                <form action="">                
                  <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
              </form></div>
                <div class="grid-item-right"><a href="../register/registro.php" class="sign-In">Sign up</a><a href="../login/checkLogin.php" class="log-In">Log in</a></div>
            </div>
            <div class="categorias" id="categorias">
                <a href="#" class="activo">All</a>
                <a href="#" id="Action">Action</a>
                <a href="#">Adventure</a>
                <a href="#">Sports</a>
                <a href="#">Racing</a>
                <a href="#">Simulation</a>
                <a href="#">Strategy</a>
                <br>
                  <select>
                    <option value=""> Year </option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                  </select>
                  <select id="selectPlatform">
                    <option value="">Platform</option>
                    <option value="PlayStation 5">PS5</option>
                    <option value="Xbox Series S/X">Xbox Series X/S</option>
                    <option value="PlayStation 4">PS4</option>
                    <option value="Xbox One">Xbox One</option>
                    <option value="Nintendo Switch">Nintendo Switch</option>
                  </select>
            </div>
        </nav>
    </header>

    <!-- Guías (HACER CON DOM y BD) -->
    <div class="guide">
        <div class="userGuideInfo">
            <div id="imageGuide"></div>
            <div id="nameUserGuide"></div>
        </div>
        <div class="titleGuide"></div>
        <div class="textGuide"></div>
    </div>

    <!-- Comentarios (HACER CON DOM y BD) -->
    <div class="createComments">
        <div class="userInfo">
            <div id="imageUser"></div>
            <div id="nameUser"></div>
        </div>
        <form action="" method="post">
            <input type="textarea" id="newComment" placeholder="Add a comment..." name="newComment" maxlength="300"/>
            <?php
                echo (isset($errores["NoComment"])) ? "<div class='errorMessage'>$errores[NoComment]</div><br>": "";
            ?>
            <input type="submit" value="Send" name="submitComment"/>
        </form>
    </div>

    <div id="readComments">

    </div>

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
</html>