<?php

require_once "config/Conexion.php";

require_once "model/UsuarioModel.php";
require_once "controller/LoginController.php";

require_once "model/Estudiante.php";
require_once "controller/EstudianteController.php";

$ruta = "login";

if(isset($_GET["ruta"])){

    $ruta = $_GET["ruta"];

}

/* LOGIN */

if($ruta == "login"){

    include "views/login.php";

}

/* DASHBOARD */

if($ruta == "dashboard"){

    include "views/dashboard.php";

}

/* ESTUDIANTES */

if($ruta == "estudiantes"){

    include "views/estudiantes.php";

}

/* APODERADOS */

if($ruta == "apoderado"){

    include "views/apoderado.php";

}

/* DOCENTES */

if($ruta == "docente"){

    include "views/docente.php";

}

/* CURSOS */

if($ruta == "curso"){

    include "views/curso.php";

}

/* AULAS */

if($ruta == "aula"){

    include "views/aula.php";

}

/* HORARIOS */

if($ruta == "horario"){

    include "views/horario.php";

}

/* CICLOS */

if($ruta == "ciclo"){

    include "views/ciclo.php";

}

/* MATRICULAS */

if($ruta == "matricula"){

    include "views/matricula.php";

}

/* DETALLE MATRICULA */

if($ruta == "detalleMatricula"){

    include "views/detalleMatricula.php";

}

/* ALIAS APODERADOS */

if($ruta == "apoderados"){

    include "views/apoderado.php";

}

?>