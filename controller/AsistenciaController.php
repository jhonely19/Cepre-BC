<?php
require_once __DIR__ . '/../model/AsistenciaDAO.php';

class AsistenciaController {
    public static function obtenerAlumnos($idCurso){
        return AsistenciaDAO::obtenerAlumnosMatriculadosPorCurso($idCurso);
    }

    public static function guardarAsistencia($data){
        // Verificamos si ya existe el registro para este día
        $existe = AsistenciaDAO::verificarExistencia($data['idEstudiante'], $data['idCurso'], $data['fecha']);
        
        if($existe){
            return AsistenciaDAO::actualizar($data);
        } else {
            return AsistenciaDAO::registrar($data);
        }
    }

    public static function listarAsistencias(){
        return AsistenciaDAO::listar();
    }
}