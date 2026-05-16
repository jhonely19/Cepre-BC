<?php

require_once "config/Conexion.php";

class UsuarioModel{

    public static function login($usuario){

        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM usuarios 
            WHERE usuario = :usuario 
            AND estado = 'activo'"
        );

        $stmt->bindParam(":usuario",$usuario);

        $stmt->execute();

        return $stmt->fetch();

    }

}
?>