<?php

require_once __DIR__ . '/../config/Conexion.php';

class Rol {

    public static function listar(){
        $sql = "SELECT idRol, nombre FROM roles ORDER BY nombre";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

