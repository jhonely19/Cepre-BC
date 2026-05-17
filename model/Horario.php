<?php

class Horario {

    public static function listar() {

        $sql = "SELECT h.*, 
                       c.nombre AS curso,
                       d.nombres AS docente,
                       a.nombre AS aula
                FROM horarios h
                INNER JOIN cursos c ON h.idCurso = c.idCurso
                INNER JOIN docentes d ON h.idDocente = d.idDocente
                INNER JOIN aulas a ON h.idAula = a.idAula";

        return Conexion::conectar()->query($sql)->fetchAll();
    }

    public static function registrar($data) {

        $sql = "INSERT INTO horarios(
                    idCurso,
                    idDocente,
                    idAula,
                    dia,
                    horaInicio,
                    horaFin
                )
                VALUES(
                    :idCurso,
                    :idDocente,
                    :idAula,
                    :dia,
                    :horaInicio,
                    :horaFin
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function obtener($id) {

        $sql = "SELECT * FROM horarios
                WHERE idHorario = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function actualizar($data) {

        $sql = "UPDATE horarios SET
                    idCurso=:idCurso,
                    idDocente=:idDocente,
                    idAula=:idAula,
                    dia=:dia,
                    horaInicio=:horaInicio,
                    horaFin=:horaFin
                WHERE idHorario=:idHorario";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);
    }

    public static function eliminar($id) {

        $sql = "DELETE FROM horarios
                WHERE idHorario = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}