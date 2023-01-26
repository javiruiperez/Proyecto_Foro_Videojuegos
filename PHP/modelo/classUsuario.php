<?php
    class Usuario extends Modelo
    {
        public function getIdUser($user)
        {
            $consulta = "SELECT * FROM usuarios WHERE usuario=:user";
            $result = $this->prepare($consulta);
            $result->bindParam(':user', $user);
            $result->execute();
            $resultadoUsuario = $result;
            // ->fetch(PDO::FETCH_ASSOC)
            foreach ($resultadoUsuario as $row) {
                $nameUser= $row['id'] ;
            }
            return $nameUser;
        }

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
            }
            return $nameUser;
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

        public function guardarComentario($idJuego, $texto, $idUsuario){
           $consulta=" INSERT INTO `comentarios` (`idJuego`, `texto`, `idUsuario`) VALUES (?, ?, ?)";
           $stmt=$this->prepare($consulta);
           $stmt->bindParam(1, $idJuego);
           $stmt->bindParam(2, $texto);
           $stmt->bindParam(3, $idUsuario);

           return  $stmt->execute();
        }

        public function sacarComentariosOrdenPorJuego($idJuego){
            $consulta="SELECT * FROM `comentarios` where idJuego=? ORDER BY idComentario;";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1,$idJuego);
            $stmt->execute();

            $arrayComentarios=$stmt->fetchAll();
            return $arrayComentarios;
        }

        public function borrarComentario($idComentario){
            $consulta="DELETE FROM `comentarios` WHERE `comentarios`.`idComentario` = ?;";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1,$idComentario);

            return  $stmt->execute();
        }
    }




?>