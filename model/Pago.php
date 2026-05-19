<?php

class Pago {

    public static function listar(){

        $sql = "SELECT 
                p.*,
                e.nombres,
                e.apellidos
                FROM pagos p
                INNER JOIN estudiantes e ON p.idEstudiante = e.idEstudiante
                ORDER BY p.idPago DESC";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

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

        // Ejecutar con SOLO los parámetros que existen en el INSERT.
        $params = [
            ":idEstudiante" => $data["idEstudiante"] ?? null,
            ":concepto" => $data["concepto"] ?? null,
            ":monto" => $data["monto"] ?? null,
            ":fechaPago" => $data["fechaPago"] ?? null,
            ":metodoPago" => $data["metodoPago"] ?? null,
            ":estado" => $data["estado"] ?? null
        ];

        return $stmt->execute($params);
    }

    public static function obtener($id){

        $sql = "SELECT * FROM pagos WHERE idPago = :id";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id",$id);
        $stmt->execute();

        return $stmt->fetch();
    }

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

        // Ejecutar con SOLO parámetros esperados por el UPDATE.
        $params = [
            ":idEstudiante" => $data["idEstudiante"] ?? null,
            ":concepto" => $data["concepto"] ?? null,
            ":monto" => $data["monto"] ?? null,
            ":fechaPago" => $data["fechaPago"] ?? null,
            ":metodoPago" => $data["metodoPago"] ?? null,
            ":estado" => $data["estado"] ?? null,
            ":idPago" => $data["idPago"] ?? null
        ];

        return $stmt->execute($params);
    }

    public static function eliminar($id){

        $sql = "DELETE FROM pagos WHERE idPago = :id";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id",$id);

        return $stmt->execute();
    }
}