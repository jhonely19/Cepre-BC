<?php

class PagoController {

    public static function listarPagos(){

        return Pago::listar();

    }

    public static function registrarPago($data){

        return Pago::registrar($data);

    }

    public static function obtenerPago($id){

        return Pago::obtener($id);

    }

    public static function actualizarPago($data){

        return Pago::actualizar($data);

    }

    public static function eliminarPago($id){

        return Pago::eliminar($id);

    }

}