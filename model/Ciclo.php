<?php

class Ciclo {

    public static function listar() {

        $sql = "SELECT * FROM ciclos";

        return Conexion::conectar()->query($sql)->fetchAll();
    }

    public static function registrar($data) {

        $sql = "INSERT INTO ciclos(
                    nombre,
                    fechaInicio,
                    fechaFin,
                    estado
                )
                VALUES(
                    :nombre,
                    :fechaInicio,
                    :fechaFin,
                    :estado
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function obtener($id) {

        $sql = "SELECT * FROM ciclos
                WHERE idCiclo = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function actualizar($data) {

        $sql = "UPDATE ciclos SET
                    nombre=:nombre,
                    fechaInicio=:fechaInicio,
                    fechaFin=:fechaFin,
                    estado=:estado
                WHERE idCiclo=:idCiclo";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function eliminar($id) {

        $sql = "DELETE FROM ciclos
                WHERE idCiclo = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}