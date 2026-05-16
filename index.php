<?php

require_once "config/Conexion.php";

require_once "model/UsuarioModel.php";

require_once "controller/LoginController.php";

$ruta = "login";

if(isset($_GET["ruta"])){

    $ruta = $_GET["ruta"];

}

if($ruta == "login"){

    include "views/login.php";

}

if($ruta == "dashboard"){

    include "views/dashboard.php";

}

?>