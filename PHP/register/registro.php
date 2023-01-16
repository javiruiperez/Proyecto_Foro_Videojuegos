<?php
include("./arrays.php");
include("./encriptarContraseñas.php");
$datesform=array(
     NAME=>"" ,
     USER=>"",
     PASSWD=>"", 
     EMAIL=>""
);
if (!isset($_REQUEST['bAcept'])) {
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- <link rel="stylesheet" href="../css/estilos.css"> -->
</head>
<body>
<form name="register" method="post" action="" enctype="multipart/form-data">
<table>
<?php
foreach($datesform as $campo=>$valor ) {
   
  ?>
<input type="text" name="<?php echo $campo ?>"><?php echo  $campo ?></input>
<br>


<?php
};
?>
<input TYPE="submit" name="bAcept" VALUE="acept">
</table>

</form>
<div>
<p>Si ya tienes cuenta <a href="../login/checkLogin.php"> iniciaSesion</a></p>
</div>
</body>
</html>

<?php
}
else{
if(preg_match("#\w#i",$_REQUEST["nombre"])==1){
    $datesform[NAME]=$_REQUEST["nombre"];
    echo "Esta bien el nombre";
    }
    else{
echo "Esta mal el nombre";
    }
        if(preg_match("#\w#i",$_REQUEST["usuario"])==1){
            $datesform[USER]=$_REQUEST["usuario"];
            echo "Esta bien el usuario";
            }
            else{
                echo "Esta mal el usuario";
            }
            if(preg_match("#\w#i",$_REQUEST["password"])==1){
                $datesform[PASSWD]=$_REQUEST["password"];
                echo "Esta bien la contraseña";
                $passwordBD = crypt_blowfish ($datesform[PASSWD]);
                $datesform[PASSWD]=$passwordBD;
                }
                else{
                    echo "Esta mal la contraseña";
                }
  if(preg_match("#[\w\._]{3,}@\w{5,}\.+[\w]{2,}#i",$_REQUEST["email"])==1){
                $datesform[EMAIL]=$_REQUEST["email"];
                echo "Esta bien el email";
                }
                else{
                    echo "Esta mal el email";
                }
            ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- <link rel="stylesheet" href="../css/estilos.css"> -->
</head>
<body>
<form name="register" method="post" action="" enctype="multipart/form-data">
<table>
<?php
foreach($datesform as $campo=>$valor ) {

       
  ?>
<input type="text" name="<?php echo $campo ?>" VALUE="<?=
         isset($valor)?$valor: "";?>"><?php echo  $campo ?></input>
<br>

<?php

    

};
?>
<input TYPE="submit" name="bAcept" VALUE="acept">
</table>

</form>
<div>
<p>Si ya tienes cuenta <a href="../login/formLogin.php"> iniciaSesion</a></p>
</div>
</body>
</html>
<?php
 $verificacionDef=false;
 
 foreach($datesform as $campo=>$valor ) {
if($valor!=""){
$verificacionDef=true;
}
else{
    $verificacionDef=false;
}
}

 if($verificacionDef==true){
  $_SESSION['nombre'] = $datosform[USER];
  try{
    include ('../BaseDeDatos/conexion.php');
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, usuario,contraseñaEncriptada, correo) values (?, ?, ?,?)");
            $stmt->bindParam(1, $datesform[NAME]);
            $stmt->bindParam(2, $datesform[USER]);
            $stmt->bindParam(3, $datesform[PASSWD]);
            $stmt->bindParam(4, $datesform[EMAIL]);
           
            $stmt->execute();
}


catch (PDOException $e) {
     // En este caso guardamos los errores en un archivo de errores log
     error_log($e->getMessage() . "##Código: " . $e->getCode() . "  " . microtime() . PHP_EOL, 3, "./logBD.txt");
     // guardamos en ·errores el error que queremos mostrar a los usuarios
     $errores['datos'] = "Ha habido un error <br>";
}
header("location:../../HTML/index.html");
echo "Todo correcto";
  }
           
           
}

            ?>



