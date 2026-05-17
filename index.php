<?php

require_once "config/Conexion.php";
require_once "model/UsuarioModel.php";
require_once "controller/LoginController.php";
require_once "model/EstudianteModel.php";
require_once "controller/EstudianteController.php";

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
if($ruta == "estudiantes"){

    include "views/estudiantes.php";

}
if($ruta == "apoderado"){

    include "views/apoderado.php";

}
if($ruta == "docente"){

    include "views/docente.php";

}
if($ruta == "curso"){

    include "views/curso.php";

}
// alias por compatibilidad
if($ruta == "apoderados"){

    include "views/apoderado.php";

}


?>