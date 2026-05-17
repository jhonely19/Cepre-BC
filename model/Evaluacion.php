<?php

class Evaluacion {

    public static function listar() {

        $sql = "SELECT e.*,
                       c.nombre AS curso
                FROM evaluaciones e
                INNER JOIN cursos c
                ON e.idCurso = c.idCurso";

        return Conexion::conectar()
        ->query($sql)
        ->fetchAll();

    }

    public static function registrar($data) {

        $sql = "INSERT INTO evaluaciones(
                    nombre,
                    porcentaje,
                    fecha,
                    idCurso
                )
                VALUES(
                    :nombre,
                    :porcentaje,
                    :fecha,
                    :idCurso
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    public static function obtener($id) {

        $sql = "SELECT * FROM evaluaciones
                WHERE idEvaluacion = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();

    }

    public static function actualizar($data) {

        $sql = "UPDATE evaluaciones
                SET nombre = :nombre,
                    porcentaje = :porcentaje,
                    fecha = :fecha,
                    idCurso = :idCurso
                WHERE idEvaluacion = :idEvaluacion";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    public static function eliminar($id) {

        $sql = "DELETE FROM evaluaciones
                WHERE idEvaluacion = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();

    }
}