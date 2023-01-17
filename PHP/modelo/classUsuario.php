<?php
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
            $consulta = "SELECT * FROM usuarios WHERE usuario=:user";
            $resultado = $this->prepare($consulta);
            $resultado->bindParam(':user', $user);
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
    }
?>