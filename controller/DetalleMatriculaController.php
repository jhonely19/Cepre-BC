<?php

class DetalleMatriculaController {

    public static function listarDetalle($idMatricula) {
        return DetalleMatricula::listar($idMatricula);
    }

    public static function registrarDetalle($data) {
        return DetalleMatricula::registrar($data);
    }

    public static function eliminarDetalle($id) {
        return DetalleMatricula::eliminar($id);
    }
}