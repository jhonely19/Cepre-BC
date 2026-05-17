<?php

class Aula {

    public static function listar() {

        $sql = "SELECT * FROM aulas";

        return Conexion::conectar()->query($sql)->fetchAll();
    }

    public static function registrar($data) {

        $sql = "INSERT INTO aulas(nombre, capacidad, ubicacion)
                VALUES(:nombre, :capacidad, :ubicacion)";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function obtener($id) {

        $sql = "SELECT * FROM aulas WHERE idAula = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function actualizar($data) {

        $sql = "UPDATE aulas SET
                nombre=:nombre,
                capacidad=:capacidad,
                ubicacion=:ubicacion
                WHERE idAula=:idAula";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function eliminar($id) {

        $sql = "DELETE FROM aulas WHERE idAula = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}