-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2018 a las 12:57:14
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curso_php`
--
CREATE DATABASE IF NOT EXISTS `BDForoUsuarios_php` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `BDForoUsuarios_php`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contraseñaEncriptada` varchar(72) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `puntuacion` int ,
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



ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentario`);
  ALTER TABLE `comentarios`
  MODIFY `idComentario` int(1) NOT NULL AUTO_INCREMENT;




  ALTER TABLE `guias`
  ADD PRIMARY KEY (`idguia`);
  ALTER TABLE `guias`
  MODIFY `idGuia` int(1) NOT NULL AUTO_INCREMENT;
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
--



INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `contraseñaEncriptada`, `correo`, `puntuacion`, `comentario`, `nivel`) VALUES (NULL, 'root', 'root', '$2a$07$usesomesillystringforehg0dedj7L/iujhXGa/PYA4EZKm/yiEW', 'root@gmail.com', '0', '0', '2');

