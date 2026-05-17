<?php

require_once __DIR__ . '/../model/Curso.php';

class CursoController {

    public static function listarCursos() {
        return Curso::listar();
    }

    public static function registrarCurso($data) {
        return Curso::registrar($data);
    }

    public static function obtenerCurso($id) {
        return Curso::obtener($id);
    }

    public static function actualizarCurso($data) {
        return Curso::actualizar($data);
    }

    public static function eliminarCurso($id) {
        return Curso::eliminar($id);
    }
}
