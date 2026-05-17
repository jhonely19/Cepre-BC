<?php

class ApoderadoController {

    public static function listarApoderados() {
        return Apoderado::listar();
    }

    public static function registrarApoderado($data) {
        return Apoderado::registrar($data);
    }

    public static function obtenerApoderado($id) {
        return Apoderado::obtener($id);
    }

    public static function actualizarApoderado($data) {
        return Apoderado::actualizar($data);
    }

    public static function eliminarApoderado($id) {
        return Apoderado::eliminar($id);
    }
}