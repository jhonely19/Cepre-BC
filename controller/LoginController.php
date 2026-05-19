<?php

require_once "model/UsuarioModel.php";

class LoginController{

    public static function ingresar(){

        if(isset($_POST["usuario"])){

            $usuario = $_POST["usuario"];
            $clave = $_POST["clave"];

            $respuesta = UsuarioModel::login($usuario);

            if($respuesta){

                if(password_verify($clave, $respuesta["clave"])){ 

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }


                    $_SESSION["login"] = "ok";
                    $_SESSION["usuario"] = $respuesta["usuario"];

                    header("Location:index.php?ruta=dashboard");

                }else{

                    // Evita imprimir antes de hacer redirects/headers
                    header("Location:index.php?ruta=login&error=clave");
                    exit;
                }

            }else{

                // Evita imprimir antes de hacer redirects/headers
                header("Location:index.php?ruta=login&error=usuario");
                exit;
            }


        }

    }

}
?>