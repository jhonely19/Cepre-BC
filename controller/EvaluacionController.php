<?php

class EvaluacionController {

    public static function listarEvaluaciones() {

        return Evaluacion::listar();

    }

    public static function registrarEvaluacion($data) {

        return Evaluacion::registrar($data);

    }

    public static function obtenerEvaluacion($id) {

        return Evaluacion::obtener($id);

    }

    public static function actualizarEvaluacion($data) {

        return Evaluacion::actualizar($data);

    }

    public static function eliminarEvaluacion($id) {

        return Evaluacion::eliminar($id);

    }
}