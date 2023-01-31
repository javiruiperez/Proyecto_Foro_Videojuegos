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
                $nameUser= $row['id'];
            }
            //Error: si no tiene la sesión iniciada da error -> que te lleve a index.php
            return $nameUser;
        }

        public function getUser($user)
        {
            $consulta = "SELECT * FROM usuarios WHERE usuario=:user";
            $result = $this->prepare($consulta);
            $result->bindParam(':user', $user);
            $result->execute();
            $resultadoUsuario = $result;

            foreach ($resultadoUsuario as $row) {
                $nameUser= $row['usuario'] ;
            }
            return $nameUser;
        }

        public function getUsername($idUser)
        {
            $consulta = "SELECT * FROM usuarios WHERE id=:idUser";
            $result = $this->prepare($consulta);
            $result->bindParam(':idUser', $idUser);
            $result->execute();
            $resultadoUsuario = $result;

            foreach ($resultadoUsuario as $row) {
                $nameUser= $row['usuario'] ;
            }
            return $nameUser;
        }


        public function getNombre($user)
        {
            $consulta = "SELECT * FROM usuarios WHERE usuario=:user";
            $result = $this->prepare($consulta);
            $result->bindParam(':user', $user);
            $result->execute();
            $resultadoUsuario = $result;

            foreach ($resultadoUsuario as $row) {
                $name= $row['nombre'] ;
            }
            return $name;
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


        public function getEmail($usuario)
        {
            $consulta = "SELECT * FROM usuarios WHERE usuario=?";
            $resultado = $this->prepare($consulta);
            $resultado->bindParam(1, $usuario);
            $resultado->execute();

            foreach($resultado as $result){
                $emailBuscado=$result['correo'];
                
            }
            return $emailBuscado;
        }


        public function insertUser($nombre,$usuario,$contraseña,$email){
            $defaultValue = 0;
            $consulta = "INSERT INTO usuarios (nombre, usuario, contraseñaEncriptada, correo, puntuacion, comentario) values (?, ?, ?, ?, ?, ?)";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $usuario);
            $stmt->bindParam(3, $contraseña);
            $stmt->bindParam(4, $email);
            $stmt->bindParam(5, $defaultValue);
            $stmt->bindParam(6, $defaultValue);
           
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

        public function sumarComentario($idUsuario){
            $consulta = "UPDATE usuarios SET comentario = comentario + 1 WHERE id=:idUsuario";
            $resultado=$this->prepare($consulta);
            $resultado->bindParam(':idUsuario', $idUsuario);
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

        public function guardarGuia($idJuego, $texto, $idUsuario){
            $consulta=" INSERT INTO `guias` (`idJuego`, `texto`, `idUsuario`) VALUES (?, ?, ?)";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1, $idJuego);
            $stmt->bindParam(2, $texto);
            $stmt->bindParam(3, $idUsuario);
 
            return  $stmt->execute();
        }
 
        public function sacarGuiaPorJuego($idJuego){
            $consulta="SELECT * FROM `guias` where idJuego=? ;";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1,$idJuego);
            $stmt->execute();

            foreach ($stmt as $row) {
                $guia = $row['texto'];
            }
            $issetGuia = isset($guia);

            if(!$issetGuia){
                return;
            } else{
                return $guia;
            }
        }

        public function borrarGuia($idGuia){
            $consulta="DELETE FROM `guias` WHERE `guias`.`idGuia` = ?;";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1,$idGuia);
 
            return  $stmt->execute();
        }

        public function mostrarUsuarioGuia($idJuego){
            $consulta = "SELECT * FROM guias WHERE idJuego = ?";
            $stmt=$this->prepare($consulta);
            $stmt->bindParam(1, $idJuego);

            foreach($stmt as $row){
                $idUser = $row['idUsuario'];
            }

            return $idUser;
        }

        public function changeProfilePicture($imageName, $username){
            // SI NO TIENE FOTO DE PERFIL GUARDAR UNA DEFAULT
            $image = $_FILES[$imageName]['name'];
            if(isset($image) && $image != ""){
                $type = $_FILES[$imageName]['type'];
                $size = $_FILES[$imageName]['size'];
                $temp = $_FILES[$imageName]['tmp_name'];

                if(!((strpos($type, "jpg") || strpos($type, "png") || strpos($type, "jpeg")) && ($size < 2000000))){
                    return "Error with the profile picture";
                } else{
                    if(is_file("../../img/".$username."/".$image)){
                        $image = time() . $image;
                    }
                    if(move_uploaded_file($temp, '../../img/'.$username.'/'.$image)){
                        echo "imagen subida";
                    } else{
                        echo "error al subir la imagen";
                    }
                }
            } else{
                echo "imagen vacía";
            }
        }
    }
?>