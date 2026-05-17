<?php

class Docente {

    public static function listar() {
        $sql = "SELECT * FROM docentes";
        return Conexion::conectar()->query($sql)->fetchAll();
    }

    public static function registrar($data) {

        $sql = "INSERT INTO docentes
        (dni, nombres, apellidos, especialidad, correo, telefono, direccion, estado, foto)
        VALUES (:dni, :nombres, :apellidos, :especialidad, :correo, :telefono, :direccion, :estado, :foto)";

        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function obtener($id) {
        $sql = "SELECT * FROM docentes WHERE idDocente = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function actualizar($data) {

        $sql = "UPDATE docentes SET
        dni=:dni,
        nombres=:nombres,
        apellidos=:apellidos,
        especialidad=:especialidad,
        correo=:correo,
        telefono=:telefono,
        direccion=:direccion,
        estado=:estado,
        foto=:foto
        WHERE idDocente=:idDocente";

        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute($data);
    }

    public static function eliminar($id) {
        $sql = "DELETE FROM docentes WHERE idDocente = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}