<?php
require_once "config/Conexion.php";

class AsistenciaDAO {
    // Lista histórica de asistencias
    public static function listar(){
        $sql = "SELECT a.idAsistencia, e.nombres, e.apellidos, c.nombre AS curso, a.fecha, a.estado
                FROM asistencias a
                INNER JOIN estudiantes e ON a.idEstudiante = e.idEstudiante
                INNER JOIN cursos c ON a.idCurso = c.idCurso
                ORDER BY a.fecha DESC";
        return Conexion::conectar()->query($sql)->fetchAll();
    }

    // Busca alumnos matriculados específicamente en el curso seleccionado
    public static function obtenerAlumnosMatriculadosPorCurso($idCurso){
        // Trae todos los estudiantes matriculados que tienen detalle_matricula en el curso seleccionado.
        // Nota: se evita filtrar por e.estado = 'activo' para no dejar fuera alumnos válidos según tu BD.
        $sql = "SELECT DISTINCT
                    e.idEstudiante, e.nombres, e.apellidos, e.foto, e.dni
                FROM detalle_matricula dm
                INNER JOIN matriculas m ON dm.idMatricula = m.idMatricula
                INNER JOIN estudiantes e ON m.idEstudiante = e.idEstudiante
                WHERE dm.idCurso = :idCurso";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":idCurso", $idCurso);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Evita duplicados: verifica si ya existe la asistencia para ese alumno/curso/fecha
    public static function verificarExistencia($idEstudiante, $idCurso, $fecha){
        $sql = "SELECT idAsistencia FROM asistencias 
                WHERE idEstudiante = :idEstudiante AND idCurso = :idCurso AND fecha = :fecha";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute([
            ":idEstudiante" => $idEstudiante,
            ":idCurso" => $idCurso,
            ":fecha" => $fecha
        ]);
        return $stmt->fetch();
    }

    public static function registrar($data){
        $sql = "INSERT INTO asistencias(idEstudiante, idCurso, fecha, estado)
                VALUES(:idEstudiante, :idCurso, :fecha, :estado)";
        return Conexion::conectar()->prepare($sql)->execute($data);
    }

    public static function actualizar($data){
        $sql = "UPDATE asistencias SET estado = :estado 
                WHERE idEstudiante = :idEstudiante AND idCurso = :idCurso AND fecha = :fecha";
        return Conexion::conectar()->prepare($sql)->execute([
            ":estado" => $data['estado'],
            ":idEstudiante" => $data['idEstudiante'],
            ":idCurso" => $data['idCurso'],
            ":fecha" => $data['fecha']
        ]);
    }
}