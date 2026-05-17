<?php

class DetalleMatricula {

    public static function listar($idMatricula) {

        $sql = "SELECT dm.idDetalle,
                       c.nombre AS curso
                FROM detalle_matricula dm
                INNER JOIN cursos c
                ON dm.idCurso = c.idCurso
                WHERE dm.idMatricula = :idMatricula";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":idMatricula", $idMatricula);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function registrar($data) {

        $sql = "INSERT INTO detalle_matricula(
                    idMatricula,
                    idCurso
                )
                VALUES(
                    :idMatricula,
                    :idCurso
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function eliminar($id) {

        $sql = "DELETE FROM detalle_matricula
                WHERE idDetalle = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}