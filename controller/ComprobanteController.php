<?php

class ComprobanteController {

    public static function listarComprobantes(){

        return Comprobante::listar();

    }

    public static function registrarComprobante($data){

        return Comprobante::registrar($data);

    }

    public static function obtenerComprobante($id){

        return Comprobante::obtener($id);

    }

    public static function actualizarComprobante($data){

        return Comprobante::actualizar($data);

    }

    public static function eliminarComprobante($id){

        return Comprobante::eliminar($id);

    }

}