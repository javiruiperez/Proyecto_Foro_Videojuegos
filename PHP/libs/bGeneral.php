<?php
function cabecera($titulo =NULL) 
{
    if (is_null($titulo)) {
        $titulo = basename(__FILE__);
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>
				<?php
    echo $titulo;
    ?>
			
			</title>
<link rel="icon" type="image/x-icon" href="../img/icon.png">
<meta charset="utf-8" />
</head>
<body>
<?php
}
function pie()
{
    echo "</body>
	</html>";
}

function randomPassword() {
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

function sendMail($mail, $pass){
    $subject = "Account Recovery - ForoGamers";
    $message = "We received an account recovery request on ForoGamers for ".$mail.". <br> This is your new password: " .$pass."<br> Please log in into your account now.";
    $headers = 'From: webmaster@example.com'       . "\r\n" .
    'Reply-To: noreply@forogamers.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    if(mail($mail, $subject, $message, $headers)){
        echo "email enviado";
    } else{
        echo "email NO enviado";
    }
}

function sinTildes($frase)
{
    $no_permitidas = array(
        "á","é","í","ó","ú","Á","É","Í","Ó","Ú","à","è","ì","ò","ù","À","È","Ì","Ò","Ù"
    );
    $permitidas = array(
        "a","e","i","o","u","A","E","I","O","U","a","e","i","o","u","A","E","I","O","U"
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
    if (! preg_match("/^[A-Za-zÑñ]+$/", sinTildes($text))) {
        $errores["name_2"] = "El nombre sólo debe tener letras";
        $valido = false;
    }

    return $valido;
}
//Funcion para los campos no requeridos
function CamposVacios($campo)
{
    if(empty($campo))
        return true;
}
//Funcion para comprobar el Nombre
function cNombre($text)
{
    if (preg_match("/^[A-Za-zÑñ]+$/", sinTildes($text)) && strlen($text)<=30)
        return true;
    else
        return false;
}
//Funcion para comprobar los apellidos
function cApellidos($text)
{
    if (preg_match("/^[A-Za-zÑñ]+[\s]+[A-Za-zÑñ]+/", sinTildes($text)) && strlen($text)<=50)
        return true;
    else
        return false;
}
//Funcion para comprobar si el nombre de usuario es válido
function UsuarioValido($usuario){
    if(preg_match("/^[a-zA-Z\_][a-zA-Z0-9]{3,12}/",$usuario)){
        return true;
    }else{
        return false;
    }
}

//Funcion para un campo contraseña
function cContra($contra)
{
    if (preg_match("/[a-zA-Z0-9\*\_\-\$&\/\\+]/", $contra) && strlen($contra) <= 15 ) {
        return true;
    } else {
        return false;
    }
}

//Funcion comprobar una fecha
function FechaValida($fecha){
    if(preg_match("/(0[1-9]|[12][0-9]|3[01])[\-\/](0[1-9]|1[012])[\-\/](19|20)\d\d/",$fecha)){
        return true;
    }else{
        return false;
    }
}
//Funcion para comprobar una direccion valida
        function ComprobarDireccion($direccion){
            if(preg_match("/^[A-Za-zÑñ]+$/", $direccion ) && strlen($direccion) <= 50){;
                return true;
            }else{
                return false;
            }
        }

?>