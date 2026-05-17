<?php

class DocenteController {

    public static function listarDocentes() {
        return Docente::listar();
    }

    public static function registrarDocente($data) {
        return Docente::registrar($data);
    }

    public static function obtenerDocente($id) {
        return Docente::obtener($id);
    }

    public static function actualizarDocente($data) {
        return Docente::actualizar($data);
    }

    public static function eliminarDocente($id) {
        return Docente::eliminar($id);
    }
}