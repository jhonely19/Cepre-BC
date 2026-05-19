<?php

class Usuario {

    public static function listar(){

        $sql = "SELECT 
                    u.*,
                    r.nombre AS rol
                FROM usuarios u
                INNER JOIN roles r ON u.idRol = r.idRol
                ORDER BY u.idUsuario DESC";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function registrar($data){

        // Evitar error 1062 (usuario duplicado)
        $sqlCheck = "SELECT idUsuario FROM usuarios WHERE usuario = :usuario";
        $stmtCheck = Conexion::conectar()->prepare($sqlCheck);
        $stmtCheck->execute([":usuario" => $data["usuario"]]);
        $existe = $stmtCheck->fetch();
        if($existe){
            return false;
        }

        $sql = "INSERT INTO usuarios(usuario,clave,estado,idRol)
                VALUES(:usuario,:clave,:estado,:idRol)";

        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function obtener($id){

        $sql = "SELECT * FROM usuarios WHERE idUsuario=:id";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public static function actualizar($data){

        $sql = "UPDATE usuarios SET
                usuario=:usuario,
                clave=:clave,
                estado=:estado,
                idRol=:idRol
                WHERE idUsuario=:idUsuario";

        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function actualizarEstados($data){
        // $data = [ idUsuario => estado, ... ]
        $sql = "UPDATE usuarios SET estado = :estado WHERE idUsuario = :idUsuario";
        $stmt = Conexion::conectar()->prepare($sql);

        $ok = true;
        foreach($data as $idUsuario => $estado){
            $res = $stmt->execute([
                ":estado" => $estado,
                ":idUsuario" => $idUsuario
            ]);
            $ok = $ok && $res;
        }
        return $ok;
    }

    public static function eliminar($id){

        $sql = "DELETE FROM usuarios WHERE idUsuario=:id";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id",$id);

        return $stmt->execute();
    }
}
