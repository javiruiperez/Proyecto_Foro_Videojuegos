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
    <title>Pagina de Inicio</title>
</head>
<body>
    <header>
        <nav>
            <div class="grid-container">
                <div class="col-1"><a href="Index.php"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="col-2">
                <form action="">                
                    <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
                </form></div>
                <div class="col-3"><a href="../PHP/register/registro.php" class="sign-In">Usuario</a></div>
            </div>
            <div class="categorias" id="categorias"> 
                <a href="#" class="genres" id="Action">Action</a>
                <a href="#"class="genres" id="Adventure">Adventure</a>
                <a href="#" class="genres" id="Sports">Sports</a>
                <a href="#" class="genres" id="Racing">Racing</a>
                <a href="#" class="genres" id="Simulation">Simulation</a>
                <a href="#" class="genres" id="Strategy">Strategy</a>
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
        <p>En ForoGamers pensamos que no hay mejor profesor para un gamer como otro gamer. Somos un foro de amantes de videojuegos con ganas de ayudar a otros jugadores resolviendo su problema con la parte más difícil de tu videojuego favorito.</p>
        <p>Aquí podrás encontrar la guía perfecta para pasarte tu videojuego o crear tu propia guía para que otros usuarios puedan verla y resolver sus dudas.</p>
        <p>En este proyecto esperamos crear una comunidad de jugadores que se ayuden mutuamente, por eso desde la administración de ForoGamers esperamos que usen este foro de manera responsable y sean respetuosos con el resto de jugadores.</p>
    </div>
    <br>
    <br>
        <!-- <section class="grid" id="grid">
          <div class="item" data-categoria="Historia" data-etiquetas="historia Historia inicicios primer equipo" data-descripcion="Aqui va la descripcion">
              <div class="item_contenido">
                  <img src="/Interfaces Proyecto/foto_ejemplo_juego.png" alt=" ">
              </div>
          </div>
        </section> -->
    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="../Interfaces Proyecto/fondo_web.png">
                <img src="../Interfaces Proyecto/fondo_web.png" width="400" height="250">
            </a>
        </div>
    </div>
    
    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="../Interfaces Proyecto/foto_ejemplo_juego.png">
                <img class="" src="../Interfaces Proyecto/foto_ejemplo_juego.png" width="400" height="250">
            </a>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="../Interfaces Proyecto/ejemplo_2.png">
                <img src="../Interfaces Proyecto/ejemplo_2.png" width="400" height="250">
            </a>
        </div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="../Interfaces Proyecto/ejemplo_3.png">
                <img src="../Interfaces Proyecto/ejemplo_3.png" width="400" height="250">
            </a>
        </div>
    </div>
  </div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>
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
    <script src="../JS/generos2.js"></script>
    <script src="../JS/perfil.js"></script>
    <script src="../JS/Busqueda.js"></script>
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
    <title>Pagina de Inicio</title>
</head>
<body>
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
                <a href="#"class="genres" id="Adventure">Adventure</a>
                <a href="#" class="genres" id="Sports">Sports</a>
                <a href="#" class="genres" id="Racing">Racing</a>
                <a href="#" class="genres" id="Simulation">Simulation</a>
                <a href="#" class="genres" id="Strategy">Strategy</a>
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
        <p>En ForoGamers pensamos que no hay mejor profesor para un gamer como otro gamer. Somos un foro de amantes de videojuegos con ganas de ayudar a otros jugadores resolviendo su problema con la parte más difícil de tu videojuego favorito.</p>
        <p>Aquí podrás encontrar la guía perfecta para pasarte tu videojuego o crear tu propia guía para que otros usuarios puedan verla y resolver sus dudas.</p>
        <p>En este proyecto esperamos crear una comunidad de jugadores que se ayuden mutuamente, por eso desde la administración de ForoGamers esperamos que usen este foro de manera responsable y sean respetuosos con el resto de jugadores.</p>
    </div>
    <br>
    <br>
    <div class="responsive">
      	<div class="gallery">
        	<a target="_blank" href="../Interfaces Proyecto/fondo_web.png">
          		<img src="../Interfaces Proyecto/fondo_web.png" width="400" height="250">
        	</a>
        </div>
    </div>
        
    <div class="responsive">
      	<div class="gallery">
        	<a target="_blank" href="../Interfaces Proyecto/foto_ejemplo_juego.png">
          		<img class="" src="../Interfaces Proyecto/foto_ejemplo_juego.png" width="400" height="250">
        	</a>
      	</div>
    </div>

    <div class="responsive">
      	<div class="gallery">
      	  	<a target="_blank" href="../Interfaces Proyecto/ejemplo_2.png">
      	  		<img src="../Interfaces Proyecto/ejemplo_2.png" width="400" height="250">
      	  	</a>
      	</div>
    </div>

    <div class="responsive">
        <div class="gallery">
            <a target="_blank" href="../Interfaces Proyecto/ejemplo_3.png">
                <img src="../Interfaces Proyecto/ejemplo_3.png" width="400" height="250">
            </a>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="clearfix"></div>
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
    <script src="../JS/generos2.js"></script>
    <script src="../JS/perfil.js"></script>
    <script src="../JS/Busqueda.js"></script>
</body>
</html>
<?php
    }
?>