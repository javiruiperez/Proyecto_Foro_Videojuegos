<?php
    $db_hostname = "localhost";
    $db_nombre = "DB_PokeBuilding"; //*********** NOMBRE DE BASE DE DATOS AQUÍ ***********//
    $db_usuario = "root";
    $db_clave = "";

    $pdo = new PDO('mysql:host=' . $db_hostname . ';dbname=' . $db_nombre . '', $db_usuario, $db_clave);
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>