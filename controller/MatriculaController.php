<?php

class MatriculaController {

    public static function listarMatriculas() {
        return Matricula::listar();
    }

    public static function registrarMatricula($data) {
        return Matricula::registrar($data);
    }

    public static function obtenerMatricula($id) {
        return Matricula::obtener($id);
    }

    public static function actualizarMatricula($data) {
        return Matricula::actualizar($data);
    }

    public static function eliminarMatricula($id) {
        return Matricula::eliminar($id);
    }
}