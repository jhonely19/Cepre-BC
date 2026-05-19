<?php
session_start();

// Cargar controladores usados por las vistas (evita errores de clases no encontradas)
require_once 'controller/EstudianteController.php';
require_once 'controller/UsuarioController.php';
require_once 'controller/ApoderadoController.php';
require_once 'controller/DocenteController.php';
require_once 'controller/CicloController.php';
require_once 'controller/CursoController.php';
require_once 'controller/AulaController.php';
require_once 'controller/HorarioController.php';
require_once 'controller/MatriculaController.php';
require_once 'controller/EvaluacionController.php';
require_once 'controller/NotaController.php';
require_once 'controller/PagoController.php';
require_once 'controller/AsistenciaController.php';
require_once 'controller/ComprobanteController.php';

$ruta = $_GET['ruta'] ?? 'web';


if ($ruta !== 'web') {
    switch ($ruta) {
        case 'login':
            require_once 'controller/LoginController.php';
            require_once 'views/login.php';
            exit;
        case 'dashboard':
            require_once 'views/dashboard.php';
            exit;
        case 'logout':
            require_once 'views/logout.php';
            exit;

        case 'usuario':
            require_once 'views/usuario.php';
            exit;
        case 'estudiantes':
            require_once 'views/estudiantes.php';
            exit;
        case 'apoderado':
            require_once 'views/apoderado.php';
            exit;
        case 'docente':
            require_once 'views/docente.php';
            exit;
        case 'ciclo':
            require_once 'views/ciclo.php';
            exit;
        case 'curso':
            require_once 'views/curso.php';
            exit;
        case 'aula':
            require_once 'views/aula.php';
            exit;
        case 'horario':
            require_once 'views/horario.php';
            exit;
        case 'matricula':
            require_once 'views/matricula.php';
            exit;
        case 'evaluacion':
            require_once 'views/evaluacion.php';
            exit;
        case 'nota':
            require_once 'views/nota.php';
            exit;
        case 'pago':
            require_once 'views/pago.php';
            exit;
        case 'asistencia':
            require_once 'views/asistencia.php';
            exit;
        case 'comprobante':
            require_once 'views/comprobante.php';
            exit;

        default:
            require_once 'views/web_index.php';
            exit;
    }
}

// HOME PÚBLICA (WEB) primero
require_once 'views/web_index.php';
exit;

