<?php

class Comprobante {

    /* =========================
       ELIMINAR POR PAGO (para evitar FK 1451)
    ========================= */

    public static function eliminarPorPago($idPago){
        $sql = "DELETE FROM comprobantes WHERE idPago = :idPago";
        $stmt = Conexion::conectar()->prepare($sql);
        return $stmt->execute([":idPago" => $idPago]);
    }

    /* =========================
       LISTAR
    ========================= */


    public static function listar(){

        $sql = "SELECT 
                c.*,
                p.concepto,
                p.monto,
                e.nombres,
                e.apellidos

                FROM comprobantes c

                INNER JOIN pagos p
                ON c.idPago = p.idPago

                INNER JOIN estudiantes e
                ON p.idEstudiante = e.idEstudiante

                ORDER BY c.idComprobante DESC";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();

    }

    /* =========================
       REGISTRAR
    ========================= */

    public static function registrar($data){

        $sql = "INSERT INTO comprobantes(
                    idPago,
                    tipo,
                    serie,
                    correlativo
                )
                VALUES(
                    :idPago,
                    :tipo,
                    :serie,
                    :correlativo
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    /* =========================
       OBTENER
    ========================= */

    public static function obtener($id){

        $sql = "SELECT * FROM comprobantes
                WHERE idComprobante = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id",$id);

        $stmt->execute();

        return $stmt->fetch();

    }

    /* =========================
       ACTUALIZAR
    ========================= */

    public static function actualizar($data){

        $sql = "UPDATE comprobantes SET

                idPago = :idPago,
                tipo = :tipo,
                serie = :serie,
                correlativo = :correlativo

                WHERE idComprobante = :idComprobante";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    /* =========================
       ELIMINAR
    ========================= */

    public static function eliminar($id){

        $sql = "DELETE FROM comprobantes
                WHERE idComprobante = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id",$id);

        return $stmt->execute();

    }

}