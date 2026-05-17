<?php

class Apoderado {

    public static function listar() {
        $sql = "SELECT a.*, e.nombres AS estudiante 
                FROM apoderados a
                INNER JOIN estudiantes e ON a.idEstudiante = e.idEstudiante";
        return Conexion::conectar()->query($sql)->fetchAll();
    }

    public static function registrar($data) {
        $sql = "INSERT INTO apoderados(idEstudiante, nombres, apellidos, telefono, parentesco, direccion)
                VALUES (:idEstudiante, :nombres, :apellidos, :telefono, :parentesco, :direccion)";
        
        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function obtener($id) {
        $sql = "SELECT * FROM apoderados WHERE idApoderado = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function actualizar($data) {
        $sql = "UPDATE apoderados 
                SET idEstudiante=:idEstudiante, nombres=:nombres, apellidos=:apellidos,
                    telefono=:telefono, parentesco=:parentesco, direccion=:direccion
                WHERE idApoderado=:idApoderado";

        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function eliminar($id) {
        $sql = "DELETE FROM apoderados WHERE idApoderado = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}