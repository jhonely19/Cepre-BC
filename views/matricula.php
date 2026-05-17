<?php

require_once "config/Conexion.php";

require_once "model/Matricula.php";
require_once "model/Estudiante.php";
require_once "model/Ciclo.php";

require_once "controller/MatriculaController.php";
require_once "controller/EstudianteController.php";
require_once "controller/CicloController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar") {

    $data = [

        "idEstudiante" => $_POST["idEstudiante"],
        "idCiclo" => $_POST["idCiclo"],
        "fecha" => $_POST["fecha"],
        "estado" => $_POST["estado"]

    ];

    MatriculaController::registrarMatricula($data);

    header("Location:index.php?ruta=matricula");

    exit;
}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "actualizar") {

    $data = [

        "idMatricula" => $_POST["idMatricula"],
        "idEstudiante" => $_POST["idEstudiante"],
        "idCiclo" => $_POST["idCiclo"],
        "fecha" => $_POST["fecha"],
        "estado" => $_POST["estado"]

    ];

    MatriculaController::actualizarMatricula($data);

    header("Location:index.php?ruta=matricula");

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    MatriculaController::eliminarMatricula($_GET["eliminar"]);

    header("Location:index.php?ruta=matricula");

    exit;
}

/* =========================
   LISTAR
========================= */

$matriculas = MatriculaController::listarMatriculas();

$estudiantes = EstudianteController::listarEstudiantes();

$ciclos = CicloController::listarCiclos();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$matriculaEditar = $idEditar
? MatriculaController::obtenerMatricula($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Matrículas</title>

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

.table td,
.table th{
    vertical-align:middle;
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
                🎓 Matrículas
            </h2>

            <small class="text-secondary">
                Administración de matrículas CEPRE
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($matriculaEditar): ?>

                        <i class="fa-solid fa-pen"></i>
                        Editar Matrícula

                    <?php else: ?>

                        <i class="fa-solid fa-user-graduate"></i>
                        Registrar Matrícula

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($matriculaEditar): ?>

                            <input
                            type="hidden"
                            name="idMatricula"
                            value="<?= $matriculaEditar["idMatricula"] ?>"
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
                                    <?= ($matriculaEditar &&
                                    $matriculaEditar["idEstudiante"] ==
                                    $e["idEstudiante"])
                                    ? 'selected' : '' ?>
                                    >

                                        <?= $e["nombres"] ?>
                                        <?= $e["apellidos"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- CICLO -->

                        <div class="mb-3">

                            <label class="form-label">
                                Ciclo
                            </label>

                            <select
                            name="idCiclo"
                            class="form-select"
                            required
                            >

                                <option value="">
                                    Seleccione ciclo
                                </option>

                                <?php foreach($ciclos as $c): ?>

                                    <option
                                    value="<?= $c["idCiclo"] ?>"
                                    <?= ($matriculaEditar &&
                                    $matriculaEditar["idCiclo"] ==
                                    $c["idCiclo"])
                                    ? 'selected' : '' ?>
                                    >

                                        <?= $c["nombre"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

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
                            value="<?= $matriculaEditar["fecha"] ?? date("Y-m-d") ?>"
                            >

                        </div>

                        <!-- ESTADO -->

                        <div class="mb-4">

                            <label class="form-label">
                                Estado
                            </label>

                            <select
                            name="estado"
                            class="form-select"
                            required
                            >

                                <option
                                value="activo"
                                <?= ($matriculaEditar &&
                                $matriculaEditar["estado"]=="activo")
                                ? 'selected' : '' ?>
                                >

                                    Activo

                                </option>

                                <option
                                value="retirado"
                                <?= ($matriculaEditar &&
                                $matriculaEditar["estado"]=="retirado")
                                ? 'selected' : '' ?>
                                >

                                    Retirado

                                </option>

                            </select>

                        </div>

                        <!-- BOTONES -->

                        <?php if($matriculaEditar): ?>

                            <button class="btn btn-warning w-100">

                                <i class="fa-solid fa-pen"></i>
                                Actualizar

                            </button>

                            <a
                            href="index.php?ruta=matricula"
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
                    Lista de Matrículas

                </div>

                <div class="card-body">

                    <!-- BUSCADOR -->

                    <div class="mb-3">

                        <input
                        type="text"
                        id="buscarMatricula"
                        class="form-control"
                        placeholder="Buscar matrícula..."
                        >

                    </div>

                    <!-- TABLA -->

                    <div class="table-responsive">

                        <table
                        class="table table-hover align-middle"
                        id="tablaMatriculas"
                        >

                            <thead class="table-primary text-center">

                                <tr>

                                    <th>ID</th>
                                    <th>Estudiante</th>
                                    <th>Ciclo</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($matriculas as $m): ?>

                                <tr>

                                    <td class="text-center">

                                        <?= $m["idMatricula"] ?>

                                    </td>

                                    <td>

                                        <strong>

                                            <?= $m["estudiante"] ?>
                                            <?= $m["apellidos"] ?>

                                        </strong>

                                    </td>

                                    <td>

                                        <?= $m["ciclo"] ?>

                                    </td>

                                    <td>

                                        <?= $m["fecha"] ?>

                                    </td>

                                    <td class="text-center">

                                        <span class="badge bg-<?= $m["estado"] == 'activo' ? 'success' : 'danger' ?>">

                                            <?= strtoupper($m["estado"]) ?>

                                        </span>

                                    </td>

                                    <td class="text-center">

                                        <!-- DETALLE MATRÍCULA -->

                                        <a
                                        href="index.php?ruta=detalleMatricula&idMatricula=<?= $m["idMatricula"] ?>"
                                        class="btn btn-primary btn-sm"
                                        title="Asignar Cursos"
                                        >

                                            <i class="fa-solid fa-book"></i>

                                        </a>

                                        <!-- EDITAR -->

                                        <a
                                        href="index.php?ruta=matricula&idEditar=<?= $m["idMatricula"] ?>"
                                        class="btn btn-warning btn-sm"
                                        title="Editar"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <!-- ELIMINAR -->

                                        <a
                                        href="index.php?ruta=matricula&eliminar=<?= $m["idMatricula"] ?>"
                                        class="btn btn-danger btn-sm"
                                        title="Eliminar"
                                        onclick="return confirm('¿Eliminar matrícula?')"
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

<script>

document.getElementById("buscarMatricula")
.addEventListener("input", function(){

    let valor = this.value.toLowerCase();

    let filas = document.querySelectorAll("#tablaMatriculas tbody tr");

    filas.forEach(fila => {

        fila.style.display =
        fila.innerText.toLowerCase().includes(valor)
        ? ""
        : "none";

    });

});

</script>

</body>
</html>