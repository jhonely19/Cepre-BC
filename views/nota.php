<?php

require_once "config/Conexion.php";

require_once "model/Nota.php";
require_once "model/Evaluacion.php";
require_once "model/Estudiante.php";

require_once "controller/NotaController.php";
require_once "controller/EvaluacionController.php";
require_once "controller/EstudianteController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "guardar") {

    $data = [

        "idEvaluacion" => $_POST["idEvaluacion"],
        "idEstudiante" => $_POST["idEstudiante"],
        "nota" => $_POST["nota"],
        "observacion" => $_POST["observacion"]

    ];

    NotaController::registrarNota($data);

    header("Location:index.php?ruta=nota");

    exit;
}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "actualizar") {

    $data = [

        "idNota" => $_POST["idNota"],
        "idEvaluacion" => $_POST["idEvaluacion"],
        "idEstudiante" => $_POST["idEstudiante"],
        "nota" => $_POST["nota"],
        "observacion" => $_POST["observacion"]

    ];

    NotaController::actualizarNota($data);

    header("Location:index.php?ruta=nota");

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    NotaController::eliminarNota($_GET["eliminar"]);

    header("Location:index.php?ruta=nota");

    exit;
}

/* =========================
   LISTAR
========================= */

$notas = NotaController::listarNotas();

$evaluaciones =
EvaluacionController::listarEvaluaciones();

$estudiantes =
EstudianteController::listarEstudiantes();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$notaEditar = $idEditar
? NotaController::obtenerNota($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Notas</title>

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
                📚 Notas
            </h2>

            <small class="text-secondary">
                Gestión de notas académicas
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORM -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($notaEditar): ?>

                        <i class="fa-solid fa-pen"></i>
                        Editar Nota

                    <?php else: ?>

                        <i class="fa-solid fa-file-pen"></i>
                        Registrar Nota

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($notaEditar): ?>

                            <input
                            type="hidden"
                            name="idNota"
                            value="<?= $notaEditar["idNota"] ?>"
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

                        <!-- EVALUACION -->

                        <div class="mb-3">

                            <label class="form-label">
                                Evaluación
                            </label>

                            <select
                            name="idEvaluacion"
                            class="form-select"
                            required
                            >

                                <option value="">
                                    Seleccione evaluación
                                </option>

                                <?php foreach($evaluaciones as $e): ?>

                                    <option
                                    value="<?= $e["idEvaluacion"] ?>"
                                    <?= ($notaEditar &&
                                    $notaEditar["idEvaluacion"] ==
                                    $e["idEvaluacion"])
                                    ? 'selected' : '' ?>
                                    >

                                        <?= $e["nombre"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- ESTUDIANTE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Estudiante
                            </label>

                            <select
                            name="idEstudiante"
                            class="form-select"
                            required
                            >

                                <option value="">
                                    Seleccione estudiante
                                </option>

                                <?php foreach($estudiantes as $e): ?>

                                    <option
                                    value="<?= $e["idEstudiante"] ?>"
                                    <?= ($notaEditar &&
                                    $notaEditar["idEstudiante"] ==
                                    $e["idEstudiante"])
                                    ? 'selected' : '' ?>
                                    >

                                        <?= $e["nombres"] ?>
                                        <?= $e["apellidos"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- NOTA -->

                        <div class="mb-3">

                            <label class="form-label">
                                Nota
                            </label>

                            <input
                            type="number"
                            step="0.01"
                            min="0"
                            max="20"
                            name="nota"
                            class="form-control"
                            required
                            value="<?= $notaEditar["nota"] ?? '' ?>"
                            >

                        </div>

                        <!-- OBSERVACION -->

                        <div class="mb-4">

                            <label class="form-label">
                                Observación
                            </label>

                            <textarea
                            name="observacion"
                            class="form-control"
                            rows="3"
                            ><?= $notaEditar["observacion"] ?? '' ?></textarea>

                        </div>

                        <!-- BOTONES -->

                        <?php if($notaEditar): ?>

                            <button class="btn btn-warning w-100">

                                <i class="fa-solid fa-pen"></i>
                                Actualizar

                            </button>

                            <a
                            href="index.php?ruta=nota"
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
                    Lista de Notas

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-primary text-center">

                                <tr>

                                    <th>ID</th>
                                    <th>Evaluación</th>
                                    <th>Estudiante</th>
                                    <th>Nota</th>
                                    <th>Estado</th>
                                    <th>Observación</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($notas as $n): ?>

                                <tr>

                                    <td class="text-center">

                                        <?= $n["idNota"] ?>

                                    </td>

                                    <td>

                                        <?= $n["evaluacion"] ?>

                                    </td>

                                    <td>

                                        <?= $n["nombres"] ?>
                                        <?= $n["apellidos"] ?>

                                    </td>

                                    <td class="text-center fw-bold">

                                        <?= $n["nota"] ?>

                                    </td>

                                    <td class="text-center">

                                        <?php if($n["nota"] >= 11): ?>

                                            <span class="badge bg-success">
                                                APROBADO
                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-danger">
                                                DESAPROBADO
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?= $n["observacion"] ?>

                                    </td>

                                    <td class="text-center">

                                        <a
                                        href="index.php?ruta=nota&idEditar=<?= $n["idNota"] ?>"
                                        class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                        href="index.php?ruta=nota&eliminar=<?= $n["idNota"] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar nota?')"
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