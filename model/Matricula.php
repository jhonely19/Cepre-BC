<?php

class Matricula {

    public static function listar() {

        $sql = "SELECT m.*,
                       e.nombres AS estudiante,
                       e.apellidos,
                       c.nombre AS ciclo
                FROM matriculas m
                INNER JOIN estudiantes e
                ON m.idEstudiante = e.idEstudiante
                INNER JOIN ciclos c
                ON m.idCiclo = c.idCiclo";

        return Conexion::conectar()->query($sql)->fetchAll();
    }

    public static function registrar($data) {

        $sql = "INSERT INTO matriculas(
                    idEstudiante,
                    idCiclo,
                    fecha,
                    estado
                )
                VALUES(
                    :idEstudiante,
                    :idCiclo,
                    :fecha,
                    :estado
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function obtener($id) {

        $sql = "SELECT * FROM matriculas
                WHERE idMatricula = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function actualizar($data) {

        $sql = "UPDATE matriculas SET

                idEstudiante=:idEstudiante,
                idCiclo=:idCiclo,
                fecha=:fecha,
                estado=:estado

                WHERE idMatricula=:idMatricula";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function eliminar($id) {

        $sql = "DELETE FROM matriculas
                WHERE idMatricula = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}