<?php

require_once "config/Conexion.php";

require_once "model/Horario.php";
require_once "model/Curso.php";
require_once "model/Docente.php";
require_once "model/Aula.php";

require_once "controller/HorarioController.php";
require_once "controller/CursoController.php";
require_once "controller/DocenteController.php";
require_once "controller/AulaController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar") {

    $data = [

        "idCurso" => $_POST["idCurso"],
        "idDocente" => $_POST["idDocente"],
        "idAula" => $_POST["idAula"],
        "dia" => $_POST["dia"],
        "horaInicio" => $_POST["horaInicio"],
        "horaFin" => $_POST["horaFin"]

    ];

    HorarioController::registrarHorario($data);

    header("Location:index.php?ruta=horario");

    exit;
}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "actualizar") {

    $data = [

        "idHorario" => $_POST["idHorario"],
        "idCurso" => $_POST["idCurso"],
        "idDocente" => $_POST["idDocente"],
        "idAula" => $_POST["idAula"],
        "dia" => $_POST["dia"],
        "horaInicio" => $_POST["horaInicio"],
        "horaFin" => $_POST["horaFin"]

    ];

    HorarioController::actualizarHorario($data);

    header("Location:index.php?ruta=horario");

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    HorarioController::eliminarHorario($_GET["eliminar"]);

    header("Location:index.php?ruta=horario");

    exit;
}

/* =========================
   LISTAR
========================= */

$horarios = HorarioController::listarHorarios();

$cursos = CursoController::listarCursos();

$docentes = DocenteController::listarDocentes();

$aulas = AulaController::listarAulas();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$horarioEditar = $idEditar
? HorarioController::obtenerHorario($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Horarios</title>
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
                🕒 Horarios
            </h2>

            <small class="text-secondary">
                Administración de horarios CEPRE
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($horarioEditar): ?>

                        <i class="fa-solid fa-pen"></i>
                        Editar Horario

                    <?php else: ?>

                        <i class="fa-solid fa-calendar-days"></i>
                        Registrar Horario

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($horarioEditar): ?>

                            <input
                                type="hidden"
                                name="idHorario"
                                value="<?= $horarioEditar["idHorario"] ?>"
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

                        <!-- CURSO -->

                        <div class="mb-3">

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
                                        <?= ($horarioEditar &&
                                        $horarioEditar["idCurso"] ==
                                        $c["idCurso"]) ? 'selected' : '' ?>
                                    >

                                        <?= $c["nombre"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- DOCENTE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Docente
                            </label>

                            <select
                                name="idDocente"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Seleccione docente
                                </option>

                                <?php foreach($docentes as $d): ?>

                                    <option
                                        value="<?= $d["idDocente"] ?>"
                                        <?= ($horarioEditar &&
                                        $horarioEditar["idDocente"] ==
                                        $d["idDocente"]) ? 'selected' : '' ?>
                                    >

                                        <?= $d["nombres"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- AULA -->

                        <div class="mb-3">

                            <label class="form-label">
                                Aula
                            </label>

                            <select
                                name="idAula"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Seleccione aula
                                </option>

                                <?php foreach($aulas as $a): ?>

                                    <option
                                        value="<?= $a["idAula"] ?>"
                                        <?= ($horarioEditar &&
                                        $horarioEditar["idAula"] ==
                                        $a["idAula"]) ? 'selected' : '' ?>
                                    >

                                        <?= $a["nombre"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- DIA -->

                        <div class="mb-3">

                            <label class="form-label">
                                Día
                            </label>

                            <select
                                name="dia"
                                class="form-select"
                                required
                            >

                                <option value="">Seleccione día</option>

                                <?php

                                $dias = [
                                    "Lunes",
                                    "Martes",
                                    "Miércoles",
                                    "Jueves",
                                    "Viernes",
                                    "Sábado"
                                ];

                                foreach($dias as $dia):

                                ?>

                                <option
                                    value="<?= $dia ?>"
                                    <?= ($horarioEditar &&
                                    $horarioEditar["dia"] ==
                                    $dia) ? 'selected' : '' ?>
                                >

                                    <?= $dia ?>

                                </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- HORA INICIO -->

                        <div class="mb-3">

                            <label class="form-label">
                                Hora Inicio
                            </label>

                            <input
                                type="time"
                                name="horaInicio"
                                class="form-control"
                                required
                                value="<?= $horarioEditar["horaInicio"] ?? '' ?>"
                            >

                        </div>

                        <!-- HORA FIN -->

                        <div class="mb-4">

                            <label class="form-label">
                                Hora Fin
                            </label>

                            <input
                                type="time"
                                name="horaFin"
                                class="form-control"
                                required
                                value="<?= $horarioEditar["horaFin"] ?? '' ?>"
                            >

                        </div>

                        <!-- BOTONES -->

                        <?php if($horarioEditar): ?>

                            <button class="btn btn-warning w-100">

                                <i class="fa-solid fa-pen"></i>
                                Actualizar

                            </button>

                            <a href="index.php?ruta=horario"
                            class="btn btn-secondary w-100 mt-2">

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
                    Lista de Horarios

                </div>

                <div class="card-body">

                    <!-- BUSCADOR -->

                    <div class="mb-3">

                        <input
                            type="text"
                            id="buscarHorario"
                            class="form-control"
                            placeholder="Buscar horario..."
                        >

                    </div>

                    <div class="table-responsive">

                        <table
                            class="table table-hover align-middle text-center"
                            id="tablaHorarios"
                        >

                            <thead class="table-primary">

                                <tr>

                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Docente</th>
                                    <th>Aula</th>
                                    <th>Día</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($horarios as $h): ?>

                                <tr>

                                    <td><?= $h["idHorario"] ?></td>

                                    <td>
                                        <strong>
                                            <?= $h["curso"] ?>
                                        </strong>
                                    </td>

                                    <td><?= $h["docente"] ?></td>

                                    <td><?= $h["aula"] ?></td>

                                    <td>

                                        <span class="badge bg-info">

                                            <?= $h["dia"] ?>

                                        </span>

                                    </td>

                                    <td><?= $h["horaInicio"] ?></td>

                                    <td><?= $h["horaFin"] ?></td>

                                    <td>

                                        <a
                                            href="index.php?ruta=horario&idEditar=<?= $h["idHorario"] ?>"
                                            class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                            href="index.php?ruta=horario&eliminar=<?= $h["idHorario"] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar horario?')"
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

document.getElementById("buscarHorario")
.addEventListener("input", function(){

    let valor = this.value.toLowerCase();

    let filas = document.querySelectorAll("#tablaHorarios tbody tr");

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