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
        // Si existe comprobante ligado al pago (FK), primero se elimina el comprobante.
        // Esto evita el error 1451: foreign key constraint fails.
        require_once __DIR__ . '/../model/Comprobante.php';
        if(method_exists('Comprobante','eliminarPorPago')){
            Comprobante::eliminarPorPago($id);
        }


        return Pago::eliminar($id);
    }
}

