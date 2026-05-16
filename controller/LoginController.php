<?php

require_once "model/UsuarioModel.php";

class LoginController{

    public static function ingresar(){

        if(isset($_POST["usuario"])){

            $usuario = $_POST["usuario"];
            $clave = $_POST["clave"];

            $respuesta = UsuarioModel::login($usuario);

            if($respuesta){

                if($respuesta["clave"] == $clave){

                    session_start();

                    $_SESSION["login"] = "ok";
                    $_SESSION["usuario"] = $respuesta["usuario"];

                    header("Location:index.php?ruta=dashboard");

                }else{

                    echo "
                    <script>
                        alert('Contraseña incorrecta');
                    </script>
                    ";

                }

            }else{

                echo "
                <script>
                    alert('Usuario incorrecto');
                </script>
                ";

            }

        }

    }

}
?>