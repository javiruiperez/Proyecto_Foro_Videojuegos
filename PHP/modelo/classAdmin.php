<?php
  include("../libs/bGeneral.php");
    class Administrador extends Modelo
    {
    
    public function modifyPassword($newPassword, $user)
    {
        $salt = '$2a$07$usesomesillystringforsalt$';
        $cryptPass= crypt($newPassword, $salt);

        $consulta = "UPDATE usuarios SET contraseñaEncriptada =:newPassword WHERE usuario=:user";
        $resultado = $this->prepare($consulta);
        $resultado->bindParam(':newPassword', $cryptPass);
        $resultado->bindParam(':user', $user);
        $resultado->execute();
    }

    }
?>