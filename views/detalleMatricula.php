<?php

require_once "config/Conexion.php";

require_once "model/DetalleMatricula.php";
require_once "model/Curso.php";
require_once "model/Matricula.php";

require_once "controller/DetalleMatriculaController.php";
require_once "controller/CursoController.php";
require_once "controller/MatriculaController.php";

/* =========================
   ID MATRICULA
========================= */

$idMatricula = $_GET["idMatricula"];

/* =========================
   OBTENER MATRICULA
========================= */

$matricula = MatriculaController::obtenerMatricula($idMatricula);

/* =========================
   GUARDAR CURSO
========================= */

if(isset($_POST["guardarCurso"])) {

    $data = [

        "idMatricula" => $_POST["idMatricula"],
        "idCurso" => $_POST["idCurso"]

    ];

    DetalleMatriculaController::registrarDetalle($data);

    header("Location:index.php?ruta=detalleMatricula&idMatricula=".$idMatricula);

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    DetalleMatriculaController::eliminarDetalle($_GET["eliminar"]);

    header("Location:index.php?ruta=detalleMatricula&idMatricula=".$idMatricula);

    exit;
}

/* =========================
   LISTAR
========================= */

$detalles = DetalleMatriculaController::listarDetalle($idMatricula);

$cursos = CursoController::listarCursos();

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Detalle Matrícula</title>
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

        <a
        href="index.php?ruta=matricula"
        class="btn btn-outline-secondary btn-sm"
        >

            <i class="fa-solid fa-arrow-left"></i>
            Volver

        </a>

        <div class="text-end">

            <h2 class="fw-bold mb-0">
                📚 Detalle Matrícula
            </h2>

            <small class="text-secondary">
                Cursos asignados al estudiante
            </small>

        </div>

    </div>

    <!-- DATOS -->

    <div class="card shadow mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <h5>

                        👨‍🎓 Estudiante:
                        <strong>

                            <?= $matricula["idEstudiante"] ?>

                        </strong>

                    </h5>

                </div>

                <div class="col-md-6">

                    <h5>

                        📅 Ciclo:
                        <strong>

                            <?= $matricula["idCiclo"] ?>

                        </strong>

                    </h5>

                </div>

            </div>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORM -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <i class="fa-solid fa-book"></i>
                    Agregar Curso

                </div>

                <div class="card-body">

                    <form method="POST">

                        <input
                            type="hidden"
                            name="idMatricula"
                            value="<?= $idMatricula ?>"
                        >

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

                                    <option value="<?= $c["idCurso"] ?>">

                                        <?= $c["nombre"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <button
                            class="btn btn-primary w-100"
                            name="guardarCurso"
                        >

                            <i class="fa-solid fa-plus"></i>
                            Agregar Curso

                        </button>

                    </form>

                </div>

            </div>

        </div>

        <!-- TABLA -->

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">

                    <i class="fa-solid fa-table"></i>
                    Cursos Asignados

                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table
                            class="table table-hover align-middle text-center"
                        >

                            <thead class="table-primary">

                                <tr>

                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($detalles as $d): ?>

                                <tr>

                                    <td>

                                        <?= $d["idDetalle"] ?>

                                    </td>

                                    <td>

                                        <strong>

                                            <?= $d["curso"] ?>

                                        </strong>

                                    </td>

                                    <td>

                                        <a
                                            href="index.php?ruta=detalleMatricula&idMatricula=<?= $idMatricula ?>&eliminar=<?= $d["idDetalle"] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar curso?')"
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