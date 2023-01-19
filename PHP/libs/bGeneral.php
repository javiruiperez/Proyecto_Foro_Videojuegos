<?php
function cabecera()
{
?>
    <header>
        <nav>
            <div class="grid-container">
                <div class="grid-item-left"></div>
                <div class="grid-item-center"><a href="Index.html"><h1 class="titulo">ForoGamers</h1></a></div>
                <div class="grid-item-right"><a href="#" class="sign-In">Registrarse</a><a href="#" class="log-In">Iniciar sesión</a></div>
            </div>
            <form action="">                
                <input type="text" class="barra_busqueda" id="barra_busqueda" placeholder="Buscar">
            </form>
            <div class="categorias" id="categorias">
                <a href="#" class="activo">Todos</a>
                <a href="#">Acción</a>
                <a href="#">Aventuras</a>
                <a href="#">Deportes</a>
                <a href="#">Carreras</a>
                <a href="#">Simulación</a>
                <a href="#">Estrategia</a>
                <br>
                  <select>
                    <option value=""> Año </option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                  </select>
                  <select>
                    <option value="">Consola</option>
                    <option value="PS2">PS2</option>
                    <option value="PS3">PS3</option>
                    <option value="PS4">PS4</option>
                    <option value="PS5">PS5</option>
                  </select>
            </div></nav>
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
                    <li><a href="#">Contacta con Nosotros</a></li>
                    <li><a href="#">Nuestros servicios</a></li>
                    <li><a href="#" download>Politicas de Privacidad</a></li>
                    <li><a href="#" download>Terminos y Condiciones</a></li>
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


function sinTildes($frase)
{
    $no_permitidas = array(
        "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù"
    );
    $permitidas = array(
        "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U"
    );
    $texto = str_replace($no_permitidas, $permitidas, $frase);
    return $texto;
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

function cTexto($text, &$errores, $max = 200, $min = 1)
{
    $valido = true;
    if ((mb_strlen($text) > $max) || (mb_strlen($text) < $min)) {
        $errores["name_1"] = "El nombre debe tener entre $min y $max letras";
        $valido = false;
    }
    if (!preg_match("/^[A-Za-zÑñ]+$/", sinTildes($text))) {
        $errores["name_2"] = "El nombre sólo debe tener letras";
        $valido = false;
    }

    return $valido;
}
//Funcion para los campos no requeridos
function CamposVacios($campo)
{
    if (empty($campo))
        return true;
}
//Funcion para comprobar el Nombre
function cNombre($text)
{
    if (preg_match("/^[A-Za-zÑñ]+$/", sinTildes($text)) && strlen($text) <= 30)
        return true;
    else
        return false;
}
//Funcion para comprobar los apellidos
function cApellidos($text)
{
    if (preg_match("/^[A-Za-zÑñ]+[\s]+[A-Za-zÑñ]+/", sinTildes($text)) && strlen($text) <= 50)
        return true;
    else
        return false;
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
//Funcion para comprobar una direccion valida
function ComprobarDireccion($direccion)
{
    if (preg_match("/^[A-Za-zÑñ]+$/", $direccion) && strlen($direccion) <= 50) {;
        return true;
    } else {
        return false;
    }
}

    ?>