<?php

class Pago {

    /* =========================
       LISTAR
    ========================= */

    public static function listar(){

        $sql = "SELECT 
                p.*,
                e.nombres,
                e.apellidos

                FROM pagos p

                INNER JOIN estudiantes e
                ON p.idEstudiante = e.idEstudiante

                ORDER BY p.idPago DESC";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();

    }

    /* =========================
       REGISTRAR
    ========================= */

    public static function registrar($data){

        $sql = "INSERT INTO pagos(
                    idEstudiante,
                    concepto,
                    monto,
                    fechaPago,
                    metodoPago,
                    estado
                )
                VALUES(
                    :idEstudiante,
                    :concepto,
                    :monto,
                    :fechaPago,
                    :metodoPago,
                    :estado
                )";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    /* =========================
       OBTENER
    ========================= */

    public static function obtener($id){

        $sql = "SELECT * FROM pagos
                WHERE idPago = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id",$id);

        $stmt->execute();

        return $stmt->fetch();

    }

    /* =========================
       ACTUALIZAR
    ========================= */

    public static function actualizar($data){

        $sql = "UPDATE pagos SET

                idEstudiante = :idEstudiante,
                concepto = :concepto,
                monto = :monto,
                fechaPago = :fechaPago,
                metodoPago = :metodoPago,
                estado = :estado

                WHERE idPago = :idPago";

        $stmt = Conexion::conectar()->prepare($sql);

        return $stmt->execute($data);

    }

    /* =========================
       ELIMINAR
    ========================= */

    public static function eliminar($id){

        $sql = "DELETE FROM pagos
                WHERE idPago = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id",$id);

        return $stmt->execute();

    }

}