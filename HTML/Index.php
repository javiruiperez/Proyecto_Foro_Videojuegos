<?php
  session_start();
  if(isset($_SESSION["user"])){
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
    <link rel="stylesheet" href="../CSS/Index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../Interfaces Proyecto/Logo.png">
    <title>Homepage - ForoGamers</title>
</head>

<body class="body">
    <header>
        <nav>
            <div class="grid-container">
                <div class="col-1"><a href="Index.php"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="col-2">
                    <form action="">                
                        <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
                    </form>
                </div>
                <?php
                    echo '<div class="col-3"><a href="../PHP/perfil/perfil.php" class="profilePicture usuario"><img src="../img/'.$_SESSION["user"].'/image.png"></a></div>';
                ?>
            </div>
            <a href="javascript:void(0);" id="icon" class="col-4" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            <div class="categorias" id="categorias"> 
                <a href="#" class="genres" id="Action">Action</a>
                <a href="#"class="genres" id="RPG">RPG</a>
                <a href="#" class="genres" id="Sports">Sports</a>
                <a href="#" class="genres" id="Shooter">Shooter</a>
                <a href="#" class="genres" id="Simulation">Simulation</a>
                <a href="#" class="genres" id="Indie">Indie</a>
  
            <select id="selectPlatform">
                <option value="">Platform</option>
                <option value="PlayStation 5">PS5</option>
                <option value="PlayStation 4">PS4</option>
                <option value="Xbox Series S/X">Xbox Series X/S</option>
                <option value="Xbox One">Xbox One</option>
                <option value="PC">PC</option>
                <option value="Nintendo Switch">Nintendo Switch</option>
            </select>
            </div>
        </nav>
    </header>
    <br>
    <br>

    <div id="borrar">
    <div class="div_principal">
        <h1>Who are we?</h1>
        <br>
        <p>ForoGamers think that there is no better teacher for a gamer than another one. We are a forum made for videogame lovers who want to help other players beating the game.</p>
        <p>Here you will find the perfect guide to beat your favourite game or create your own guide to help others.</p>
        <p>We hope to create a community of players who help each other.</p>
    </div>
    <br>
    <br>
      
    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>
  </div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>
    </div>
    <div class="Botones" id="Botones">
        <button type="button" class="Atras" id="Atras">Atras</button>
        <button type="button" class="Siguiente" id="Siguiente">Siguiente</button>
    </div>
    <div id="Images"></div>

    <footer>
        <div class="footer">
            <div class="row">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our services</a></li>
                    <li><a href="#">Privacy politics</a></li>
                    <li><a href="#">Terms and conditions</a></li>
                </ul>
            </div>
            <div class="row">
                ForoGamers Copyright © 2023 FG - All rights reserved || Designed By: Javier Ruiperez, Fran Botella, Oscar Delicado
            </div>
        </div>
    </footer>                                                                                   
    <script src="../JS/generos2.js"></script>
    <script>
function myFunction() {
  var x = document.getElementById("categorias");
  if (x.style.display === "none" || x.style.display==="") {
    x.style.display = "block";
   
  } else {
    x.style.display = "none";
  }
  
}

</script>
</body>
</html>

<?php
    }
    else{
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
    <link rel="stylesheet" href="../CSS/Index.css">
    <link rel="icon" type="image/x-icon" href="../Interfaces Proyecto/Logo.png">
    <title>Homepage - ForoGamers</title>
</head>
<body class="body">
    <header>
        <nav>
            <div class="grid-container">
                <div class="col-1"><a href="Index.php"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="col-2">
                <form action="">                
					<input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
              </form></div>
                	<div class="col-3"><a href="../PHP/register/registro.php" class="sign-In">Sign up</a><a href="../PHP/login/checkLogin.php" class="log-In">Log in</a></div>
            </div>
            <div class="categorias" id="categorias">  
                <a href="#" class="genres" id="Action">Action</a>
                <a href="#"class="genres" id="RPG">RPG</a>
                <a href="#" class="genres" id="Sports">Sports</a>
                <a href="#" class="genres" id="Shooter">Shooter</a>
                <a href="#" class="genres" id="Simulation">Simulation</a>
                <a href="#" class="genres" id="Indie">Indie</a>
                <br>
            <select id="selectPlatform">
        		<option value="">Platform</option>
        		<option value="PlayStation 5">PS5</option>
        		<option value="PlayStation 4">PS4</option>
        		<option value="Xbox Series S/X">Xbox Series X/S</option>
        		<option value="Xbox One">Xbox One</option>
        		<option value="PC">PC</option>
        		<option value="Nintendo Switch">Nintendo Switch</option>
            </select>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <div id="borrar">
    <div class="div_principal">
        <h1>Who are we?</h1>
        <br>
        <p>ForoGamers think that there is no better teacher for a gamer than another one. We are a forum made for videogame lovers who want to help other players beating the game.</p>
        <p>Here you will find the perfect guide to beat your favourite game or create your own guide to help others.</p>
        <p>We hope to create a community of players who help each other.</p>
    </div>
    <br>
    <br>
    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>
        
    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <img class="prede" src="../Interfaces Proyecto/loadingImage.png" width="400" height="250">
                <p class="tituloJuego"></p>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>
    </div>
    <div class="Botones" id="Botones">
        <button type="button" class="Atras" id="Atras">Atras</button>
        <button type="button" class="Siguiente" id="Siguiente">Siguiente</button>
    </div>
    <div id="Images"></div>
    <footer>
        <div class="footer">
            <div class="row">
                <ul>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Our services</a></li>
                    <li><a href="#">Privacy politics</a></li>
                    <li><a href="#">Terms and conditions</a></li>
                </ul>
            </div>
            <div class="row">
                ForoGamers Copyright © 2023 FG - All rights reserved || Designed By: Javier Ruiperez, Fran Botella, Oscar Delicado
            </div>
        </div>
    </footer>                                                                                          
    <script src="../JS/generos2.js"></script>
   
</body>
</html>
<?php
    }
?>