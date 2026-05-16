<?php

class Conexion{

    public static function conectar(){

        $host = "localhost";
        $dbname = "cepre_bc";
        $user = "root";
        $pass = "";

        $conexion = new PDO(
            "mysql:host=".$host.";dbname=".$dbname,
            $user,
            $pass
        );

        $conexion->exec("SET NAMES utf8");

        return $conexion;

    }

}
?>