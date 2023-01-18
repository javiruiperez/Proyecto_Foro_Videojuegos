<?php
include("../register/encriptarContraseñas.php");
    class Usuario extends Modelo
    {
        public function getUser($user)
        {
            $consulta = "SELECT * FROM usuarios WHERE usuario=:user";
            $result = $this->prepare($consulta);
            $result->bindParam(':user', $user);
            $result->execute();
            $resultadoUsuario = $result->fetch(PDO::FETCH_ASSOC);

            return $resultadoUsuario;
        }

        public function checkPassword($user, $password)
        {
            $consulta = "SELECT * FROM usuarios WHERE usuario=?";
            $resultado = $this->prepare($consulta);
            $resultado->bindParam(1, $user);
            $resultado->execute();
            foreach($resultado as $result){
                $checkPass = crypt($password, $result['contraseñaEncriptada']);
                if($checkPass === $result['contraseñaEncriptada']){
                    return true;
                } else{
                    return false;
                }
            }
        }

        public function checkEmail($email)
        {
            $consulta = "SELECT * FROM usuarios WHERE correo=?";
            $resultado = $this->prepare($consulta);
            $resultado->bindParam(1, $email);
            $resultado->execute();

            foreach($resultado as $result){
                if($email === $result['correo']){
                    return true;
                } else{
                    return false;
                }
            }
        }

        public function modifyPassword($newPassword, $email)
        {
            $cryptPass = crypt_blowfish($newPassword);

            $consulta = "UPDATE usuarios SET contraseñaEncriptada =:newPassword WHERE correo=:email";
            $resultado = $this->prepare($consulta);
            $resultado->bindParam(':newPassword', $cryptPass);
            $resultado->bindParam(':email', $email);
            $resultado->execute();
        }
    }
?>