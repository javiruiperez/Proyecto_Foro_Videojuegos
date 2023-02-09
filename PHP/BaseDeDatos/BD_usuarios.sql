SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `BDForoUsuarios_php` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `BDForoUsuarios_php`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contraseñaEncriptada` varchar(72) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `comentario` int,
  `nivel` int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comentarios` (
  `idComentario` int NOT NULL,
  `idJuego` int NOT NULL,
  `texto` text NOT NULL,
  `idUsuario` int NOT NULL,
  `fecha` DATE

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `guias` (
  `idGuia` int NOT NULL,
  `idJuego` int NOT NULL,
  `texto` text NOT NULL,
  `idUsuario` int NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `contraseñaEncriptada`, `correo`, `comentario`, `nivel`) VALUES ('1', 'root', 'root', '$2a$07$usesomesillystringforehg0dedj7L/iujhXGa/PYA4EZKm/yiEW', 'root@gmail.com', '0', '2');

ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`);
  ALTER TABLE `comentarios`
  MODIFY `idComentario` int(1) NOT NULL AUTO_INCREMENT;

ALTER TABLE `guias`
  ADD PRIMARY KEY (`idguia`);
  ALTER TABLE `guias`
  MODIFY `idGuia` int(1) NOT NULL AUTO_INCREMENT;


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
