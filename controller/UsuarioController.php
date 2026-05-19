<?php

class UsuarioController {

    public static function listarUsuarios(){
        return Usuario::listar();
    }

    public static function registrarUsuario($data){

        // 🔥 encriptar clave
        $data["clave"] = password_hash($data["clave"], PASSWORD_DEFAULT);

        return Usuario::registrar($data);
    }

    public static function obtenerUsuario($id){
        return Usuario::obtener($id);
    }

    public static function actualizarUsuario($data){

        if(!empty($data["clave"])){
            $data["clave"] = password_hash($data["clave"], PASSWORD_DEFAULT);
        }

        return Usuario::actualizar($data);
    }

    public static function actualizarEstados($data){
        // $data = [ 'idUsuario' => ['estado'=>...], ... ]
        return Usuario::actualizarEstados($data);
    }

    public static function eliminarUsuario($id){
        return Usuario::eliminar($id);
    }
}
