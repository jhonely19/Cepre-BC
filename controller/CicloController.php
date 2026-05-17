<?php

class CicloController {

    public static function listarCiclos() {
        return Ciclo::listar();
    }

    public static function registrarCiclo($data) {
        return Ciclo::registrar($data);
    }

    public static function obtenerCiclo($id) {
        return Ciclo::obtener($id);
    }

    public static function actualizarCiclo($data) {
        return Ciclo::actualizar($data);
    }

    public static function eliminarCiclo($id) {
        return Ciclo::eliminar($id);
    }
}