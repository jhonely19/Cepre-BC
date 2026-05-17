<?php

require_once "model/Estudiante.php";

class EstudianteController{

    /* LISTAR */

    public static function listarEstudiantes(){

        $respuesta = EstudianteModel::listar();

        return $respuesta;

    }

    
    /* OBTENER PARA EDICIÓN */

    public static function obtenerEstudiante($id){

        return EstudianteModel::obtenerPorId($id);

    }

    /* REGISTRAR */

    public static function registrarEstudiante(){

        if(isset($_POST["dni"])){

            /* FOTO */

            $foto = "";

            if(isset($_FILES["foto"]["tmp_name"]) && !empty($_FILES["foto"]["tmp_name"])){

                $foto = $_FILES["foto"]["name"];

                $ruta = "assets/img/estudiantes/".$foto;

                move_uploaded_file(
                    $_FILES["foto"]["tmp_name"],
                    $ruta
                );

            }

            $datos = array(

                "dni" => $_POST["dni"],
                "nombres" => $_POST["nombres"],
                "apellidos" => $_POST["apellidos"],
                "correo" => $_POST["correo"],
                "telefono" => $_POST["telefono"],
                "carrera" => $_POST["carrera"],

                "sexo" => $_POST["sexo"],
                "fechaNacimiento" => $_POST["fechaNacimiento"],
                "direccion" => $_POST["direccion"],
                "colegioProcedencia" => $_POST["colegioProcedencia"],
                "foto" => $foto,
                "estado" => $_POST["estado"]

            );

            $respuesta = EstudianteModel::registrar($datos);

            if($respuesta == "ok"){

                echo '

                <script>

                    window.location = "index.php?ruta=estudiantes";

                </script>

                ';

            }

        }

    }


    /* EDITAR (UPDATE) */

    public static function editarEstudiante(){

        if(isset($_POST["btnActualizar"])){

            $id = $_POST["idEstudiante"];


            $est = EstudianteModel::obtenerPorId($id);
            $fotoActual = $est ? $est["foto"] : "";

            $foto = $fotoActual;
            if(isset($_FILES["foto"]["tmp_name"]) && !empty($_FILES["foto"]["tmp_name"])){
                $foto = $_FILES["foto"]["name"];
                $ruta = "assets/img/estudiantes/".$foto;
                move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
            }

            $datos = array(
                "dni" => $_POST["dni"],
                "nombres" => $_POST["nombres"],
                "apellidos" => $_POST["apellidos"],
                "correo" => $_POST["correo"],
                "telefono" => $_POST["telefono"],
                "carrera" => $_POST["carrera"],

                "sexo" => $_POST["sexo"],
                "fechaNacimiento" => $_POST["fechaNacimiento"],
                "direccion" => $_POST["direccion"],
                "colegioProcedencia" => $_POST["colegioProcedencia"],
                "foto" => $foto,
                "estado" => $_POST["estado"]
            );

            $respuesta = EstudianteModel::actualizar($id, $datos);

            if($respuesta == "ok"){
                echo '
                <script>
                    window.location = "index.php?ruta=estudiantes";
                </script>
                ';
            }
        }
    }

    /* ELIMINAR */

    public static function eliminarEstudiante(){

        if(isset($_GET["idEliminar"])){

            $id = $_GET["idEliminar"];

            $respuesta = EstudianteModel::eliminar($id);

            if($respuesta == "ok"){

                echo '

                <script>

                    window.location = "index.php?ruta=estudiantes";

                </script>

                ';

            }

        }

    }

}

?>
