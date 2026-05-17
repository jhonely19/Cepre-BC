<?php

class Nota {

    public static function listar() {

        $sql = "SELECT n.*,
                       e.nombre AS evaluacion,
                       es.nombres,
                       es.apellidos
                FROM notas n
                INNER JOIN evaluaciones e
                ON n.idEvaluacion = e.idEvaluacion
                INNER JOIN estudiantes es
                ON n.idEstudiante = es.idEstudiante";

        return Conexion::conectar()
        ->query($sql)
        ->fetchAll();

    }

    public static function registrar($data) {

        $sql = "INSERT INTO notas(
                    idEvaluacion,
                    idEstudiante,
                    nota,
                    observacion
                )
                VALUES(
                    :idEvaluacion,
                    :idEstudiante,
                    :nota,
                    :observacion
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    public static function obtener($id) {

        $sql = "SELECT * FROM notas
                WHERE idNota = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();

    }

    public static function actualizar($data) {

        $sql = "UPDATE notas
                SET idEvaluacion = :idEvaluacion,
                    idEstudiante = :idEstudiante,
                    nota = :nota,
                    observacion = :observacion
                WHERE idNota = :idNota";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    public static function eliminar($id) {

        $sql = "DELETE FROM notas
                WHERE idNota = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();

    }
}