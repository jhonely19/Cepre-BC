<?php

class Curso {

    public static function listar() {

        $sql = "SELECT * FROM cursos";

        return Conexion::conectar()->query($sql)->fetchAll();
    }

    public static function registrar($data) {

        $sql = "INSERT INTO cursos(nombre, descripcion, creditos, estado)
                VALUES(:nombre, :descripcion, :creditos, :estado)";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function obtener($id) {

        $sql = "SELECT * FROM cursos WHERE idCurso = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function actualizar($data) {

        $sql = "UPDATE cursos SET
                nombre=:nombre,
                descripcion=:descripcion,
                creditos=:creditos,
                estado=:estado
                WHERE idCurso=:idCurso";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function eliminar($id) {

        $sql = "DELETE FROM cursos WHERE idCurso = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}