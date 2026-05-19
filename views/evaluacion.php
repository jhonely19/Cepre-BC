<?php

require_once "config/Conexion.php";

require_once "model/Evaluacion.php";
require_once "model/Curso.php";

require_once "controller/EvaluacionController.php";
require_once "controller/CursoController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "guardar") {

    $data = [

        "nombre" => $_POST["nombre"],
        "porcentaje" => $_POST["porcentaje"],
        "fecha" => $_POST["fecha"],
        "idCurso" => $_POST["idCurso"]

    ];

    EvaluacionController::registrarEvaluacion($data);

    header("Location:index.php?ruta=evaluacion");

    exit;
}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "actualizar") {

    $data = [

        "idEvaluacion" => $_POST["idEvaluacion"],
        "nombre" => $_POST["nombre"],
        "porcentaje" => $_POST["porcentaje"],
        "fecha" => $_POST["fecha"],
        "idCurso" => $_POST["idCurso"]

    ];

    EvaluacionController::actualizarEvaluacion($data);

    header("Location:index.php?ruta=evaluacion");

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    EvaluacionController::eliminarEvaluacion(
        $_GET["eliminar"]
    );

    header("Location:index.php?ruta=evaluacion");

    exit;
}

/* =========================
   LISTAR
========================= */

$evaluaciones =
EvaluacionController::listarEvaluaciones();

$cursos =
CursoController::listarCursos();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$evaluacionEditar = $idEditar
? EvaluacionController::obtenerEvaluacion($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Evaluaciones</title>
<link rel="icon" type="image/png" href="assets/img/logos/logo.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    background:#f4f7fc;
}

.card{
    border:none;
    border-radius:15px;
}

</style>

</head>

<body>

<div class="container-fluid p-4">

    <!-- HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <a href="index.php?ruta=dashboard"
        class="btn btn-outline-secondary btn-sm">

            <i class="fa-solid fa-arrow-left"></i>
            Volver

        </a>

        <div class="text-end">

            <h2 class="fw-bold mb-0">
                📝 Evaluaciones
            </h2>

            <small class="text-secondary">
                Gestión de evaluaciones
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($evaluacionEditar): ?>

                        <i class="fa-solid fa-pen"></i>
                        Editar Evaluación

                    <?php else: ?>

                        <i class="fa-solid fa-file-pen"></i>
                        Registrar Evaluación

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($evaluacionEditar): ?>

                            <input
                            type="hidden"
                            name="idEvaluacion"
                            value="<?= $evaluacionEditar["idEvaluacion"] ?>"
                            >

                            <input
                            type="hidden"
                            name="accion"
                            value="actualizar"
                            >

                        <?php else: ?>

                            <input
                            type="hidden"
                            name="accion"
                            value="guardar"
                            >

                        <?php endif; ?>

                        <!-- NOMBRE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre
                            </label>

                            <input
                            type="text"
                            name="nombre"
                            class="form-control"
                            required
                            value="<?= $evaluacionEditar["nombre"] ?? '' ?>"
                            >

                        </div>

                        <!-- PORCENTAJE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Porcentaje
                            </label>

                            <input
                            type="number"
                            step="0.01"
                            name="porcentaje"
                            class="form-control"
                            required
                            value="<?= $evaluacionEditar["porcentaje"] ?? '' ?>"
                            >

                        </div>

                        <!-- FECHA -->

                        <div class="mb-3">

                            <label class="form-label">
                                Fecha
                            </label>

                            <input
                            type="date"
                            name="fecha"
                            class="form-control"
                            required
                            value="<?= $evaluacionEditar["fecha"] ?? date("Y-m-d") ?>"
                            >

                        </div>

                        <!-- CURSO -->

                        <div class="mb-4">

                            <label class="form-label">
                                Curso
                            </label>

                            <select
                            name="idCurso"
                            class="form-select"
                            required
                            >

                                <option value="">
                                    Seleccione curso
                                </option>

                                <?php foreach($cursos as $c): ?>

                                    <option
                                    value="<?= $c["idCurso"] ?>"
                                    <?= ($evaluacionEditar &&
                                    $evaluacionEditar["idCurso"] ==
                                    $c["idCurso"])
                                    ? 'selected' : '' ?>
                                    >

                                        <?= $c["nombre"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- BOTONES -->

                        <?php if($evaluacionEditar): ?>

                            <button class="btn btn-warning w-100">

                                <i class="fa-solid fa-pen"></i>
                                Actualizar

                            </button>

                            <a
                            href="index.php?ruta=evaluacion"
                            class="btn btn-secondary w-100 mt-2"
                            >

                                Cancelar

                            </a>

                        <?php else: ?>

                            <button class="btn btn-primary w-100">

                                <i class="fa-solid fa-floppy-disk"></i>
                                Guardar

                            </button>

                        <?php endif; ?>

                    </form>

                </div>

            </div>

        </div>

        <!-- TABLA -->

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">

                    <i class="fa-solid fa-table"></i>
                    Lista de Evaluaciones

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-primary text-center">

                                <tr>

                                    <th>ID</th>
                                    <th>Evaluación</th>
                                    <th>Curso</th>
                                    <th>Porcentaje</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($evaluaciones as $e): ?>

                                <tr>

                                    <td class="text-center">

                                        <?= $e["idEvaluacion"] ?>

                                    </td>

                                    <td>

                                        <?= $e["nombre"] ?>

                                    </td>

                                    <td>

                                        <?= $e["curso"] ?>

                                    </td>

                                    <td class="text-center">

                                        <?= $e["porcentaje"] ?>%

                                    </td>

                                    <td>

                                        <?= $e["fecha"] ?>

                                    </td>

                                    <td class="text-center">

                                        <a
                                        href="index.php?ruta=evaluacion&idEditar=<?= $e["idEvaluacion"] ?>"
                                        class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                        href="index.php?ruta=evaluacion&eliminar=<?= $e["idEvaluacion"] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar evaluación?')"
                                        >

                                            <i class="fa-solid fa-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>