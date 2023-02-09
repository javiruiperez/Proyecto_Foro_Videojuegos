<?php
function cabecera()
{
?>
    <header>
        <nav>
            <div class="grid-container">
                <div class="col-1"><a href="../../HTML/Index.php"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="col-2">
                    <form action="">                
                        <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Search a game">
                    </form>
                </div>
                <div class="col-3"><a href="../register/registro.php" class="sign-In">Sign up</a><a href="../login/checkLogin.php" class="log-In">Log in</a></div>
            </div>
        </nav>
    </header>
    <?php
}

function pie()
{
    ?>
    <footer>
        <div class="footer">
            <div class="row">
                <ul>
                    <li><a href="https://twitter.com"><img src="../../Interfaces Proyecto/twitter-logo.png" class="imageFooter"/></a></li>
                    <li><a href="https://instagram.com"><img src="../../Interfaces Proyecto/insta-logo.png" class="imageFooter"/></a></li>
                    <li><a href="https://facebook.com"><img src="../../Interfaces Proyecto/facebook-logo.png" class="imageFooter"/></a></li>
                </ul>
            </div>
            <div class="row">
                ForoGamers Copyright © 2023 FG - All rights reserved || Designed By: Javier Ruiperez, Fran Botella, Oscar Delicado
            </div>
        </div>
    </footer>
    <?php
}

function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $strPassword = implode($pass);

    return $strPassword;
}

function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}

function recoge($var)
{
    if (isset($_REQUEST[$var]))
        $tmp = strip_tags(sinEspacios($_REQUEST[$var]));
    else
        $tmp = "";

    return $tmp;
}

//Funcion para comprobar si el nombre de usuario es válido
function UsuarioValido($usuario)
{
    if (preg_match("/^[a-zA-Z\_][a-zA-Z0-9]{3,12}/", $usuario)) {
        return true;
    } else {
        return false;
    }
}

//Funcion para un campo contraseña
function cContra($contra)
{
    if (preg_match("/[a-zA-Z0-9\*\_\-\$&\/\\+]/", $contra) && strlen($contra) <= 15) {
        return true;
    } else {
        return false;
    }
}

//Funcion comprobar una fecha
function FechaValida($fecha)
{
    if (preg_match("/(0[1-9]|[12][0-9]|3[01])[\-\/](0[1-9]|1[012])[\-\/](19|20)\d\d/", $fecha)) {
        return true;
    } else {
        return false;
    }
}
    ?>