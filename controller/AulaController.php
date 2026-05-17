<?php

class AulaController {

    public static function listarAulas() {
        return Aula::listar();
    }

    public static function registrarAula($data) {
        return Aula::registrar($data);
    }

    public static function obtenerAula($id) {
        return Aula::obtener($id);
    }

    public static function actualizarAula($data) {
        return Aula::actualizar($data);
    }

    public static function eliminarAula($id) {
        return Aula::eliminar($id);
    }
}