<?php
    class Modelo extends PDO // this class conect with BD 
    {
        private $conexion;

        public function __construct()
        {
            parent::__construct('mysql:host=' . Config::$db_hostname . ';dbname=' . Config::$db_nombre . '', Config::$db_usuario, Config::$db_clave);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            parent::exec("set names utf8");
        }
    }
?>