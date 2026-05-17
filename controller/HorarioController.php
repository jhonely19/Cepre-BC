<?php

class HorarioController {

    public static function listarHorarios() {
        return Horario::listar();
    }

    public static function registrarHorario($data) {
        return Horario::registrar($data);
    }

    public static function obtenerHorario($id) {
        return Horario::obtener($id);
    }

    public static function actualizarHorario($data) {
        return Horario::actualizar($data);
    }

    public static function eliminarHorario($id) {
        return Horario::eliminar($id);
    }
}