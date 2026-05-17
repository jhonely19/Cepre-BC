<?php

class NotaController {

    public static function listarNotas() {

        return Nota::listar();

    }

    public static function registrarNota($data) {

        return Nota::registrar($data);

    }

    public static function obtenerNota($id) {

        return Nota::obtener($id);

    }

    public static function actualizarNota($data) {

        return Nota::actualizar($data);

    }

    public static function eliminarNota($id) {

        return Nota::eliminar($id);

    }
}