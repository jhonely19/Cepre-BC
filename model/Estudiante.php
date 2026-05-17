<?php

require_once "config/Conexion.php";

class EstudianteModel{

    /* LISTAR */

    public static function listar(){

        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM estudiantes"
        );

        $stmt->execute();

        return $stmt->fetchAll();

    }


    /* OBTENER POR ID */

    public static function obtenerPorId($id){

        $stmt = Conexion::conectar()->prepare(
            "SELECT * FROM estudiantes WHERE idEstudiante = :id"
        );

        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    /* REGISTRAR */

    public static function registrar($datos){

        $stmt = Conexion::conectar()->prepare(

            "INSERT INTO estudiantes(

                dni,
                nombres,
                apellidos,
                sexo,
                fechaNacimiento,
                correo,
                telefono,
                direccion,
                colegioProcedencia,
                carrera,
                foto,
                estado

            ) VALUES(

                :dni,
                :nombres,
                :apellidos,
                :sexo,
                :fechaNacimiento,
                :correo,
                :telefono,
                :direccion,
                :colegioProcedencia,
                :carrera,
                :foto,
                :estado

            )"

        );

        $stmt->bindParam(":dni",$datos["dni"]);
        $stmt->bindParam(":nombres",$datos["nombres"]);
        $stmt->bindParam(":apellidos",$datos["apellidos"]);
        $stmt->bindParam(":correo",$datos["correo"]);
        $stmt->bindParam(":telefono",$datos["telefono"]);
        $stmt->bindParam(":carrera",$datos["carrera"]);

        $stmt->bindParam(":sexo",$datos["sexo"]);
        $stmt->bindParam(":fechaNacimiento",$datos["fechaNacimiento"]);
        $stmt->bindParam(":direccion",$datos["direccion"]);
        $stmt->bindParam(":colegioProcedencia",$datos["colegioProcedencia"]);
        $stmt->bindParam(":foto",$datos["foto"]);
        $stmt->bindParam(":estado",$datos["estado"]);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

    }

    /* ACTUALIZAR */

    public static function actualizar($id, $datos){

        $foto = $datos["foto"];

        $stmt = Conexion::conectar()->prepare(
            "UPDATE estudiantes SET 
                dni = :dni,
                nombres = :nombres,
                apellidos = :apellidos,
                sexo = :sexo,
                fechaNacimiento = :fechaNacimiento,
                correo = :correo,
                telefono = :telefono,
                direccion = :direccion,
                colegioProcedencia = :colegioProcedencia,
                carrera = :carrera,
                foto = :foto,
                estado = :estado
            WHERE idEstudiante = :id"
        );

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":dni", $datos["dni"]);
        $stmt->bindParam(":nombres", $datos["nombres"]);
        $stmt->bindParam(":apellidos", $datos["apellidos"]);
        $stmt->bindParam(":sexo", $datos["sexo"]);
        $stmt->bindParam(":fechaNacimiento", $datos["fechaNacimiento"]);
        $stmt->bindParam(":correo", $datos["correo"]);
        $stmt->bindParam(":telefono", $datos["telefono"]);
        $stmt->bindParam(":direccion", $datos["direccion"]);
        $stmt->bindParam(":colegioProcedencia", $datos["colegioProcedencia"]);
        $stmt->bindParam(":carrera", $datos["carrera"]);
        $stmt->bindParam(":foto", $foto);
        $stmt->bindParam(":estado", $datos["estado"]);

        if($stmt->execute()){
            return "ok";
        }

        return "error";
    }

    /* ELIMINAR */

    public static function eliminar($id){

        $stmt = Conexion::conectar()->prepare(

            "DELETE FROM estudiantes
            WHERE idEstudiante = :id"

        );

        $stmt->bindParam(":id",$id);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

    }

}

?>
