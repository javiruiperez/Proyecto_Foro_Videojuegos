<?php
    class Usuario extends Modelo
    {
        public function getUser($user)
        {
            $consulta = "SELECT * FROM usuarios WHERE usuario=:user";
            $result = $this->prepare($consulta);
            $result->bindParam(':user', $user);
            $result->execute();
            $resultadoUsuario = $result;
            // ->fetch(PDO::FETCH_ASSOC)
            foreach ($resultadoUsuario as $row) {

                $nameUser= $row['usuario'] ;
                return $nameUser;
            }
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

        public function insertUser($nombre,$usuario,$contraseña,$email){
            $consulta = "INSERT INTO usuarios (nombre, usuario,contraseñaEncriptada, correo) values (?, ?, ?,?)";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $usuario);
            $stmt->bindParam(3, $contraseña);
            $stmt->bindParam(4, $email);
           
            return  $stmt->execute();
        }

        public function modifyPassword($newPassword, $email)
        {
            $salt = '$2a$07$usesomesillystringforsalt$';
            $cryptPass= crypt($newPassword, $salt);

            $consulta = "UPDATE usuarios SET contraseñaEncriptada =:newPassword WHERE correo=:email";
            $resultado = $this->prepare($consulta);
            $resultado->bindParam(':newPassword', $cryptPass);
            $resultado->bindParam(':email', $email);
            $resultado->execute();
        }
    }
?>