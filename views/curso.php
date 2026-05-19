<?php

require_once "config/Conexion.php";
require_once "model/Curso.php";
require_once "controller/CursoController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar") {

    $data = [

        "nombre" => $_POST["nombre"],
        "descripcion" => $_POST["descripcion"],
        "creditos" => $_POST["creditos"],
        "estado" => $_POST["estado"]

    ];

    CursoController::registrarCurso($data);

    header("Location: index.php?ruta=curso");

    exit;
}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "actualizar") {

    $data = [

        "idCurso" => $_POST["idCurso"],
        "nombre" => $_POST["nombre"],
        "descripcion" => $_POST["descripcion"],
        "creditos" => $_POST["creditos"],
        "estado" => $_POST["estado"]

    ];

    CursoController::actualizarCurso($data);

    header("Location: index.php?ruta=curso");

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    CursoController::eliminarCurso($_GET["eliminar"]);

    header("Location: index.php?ruta=curso");

    exit;
}

/* =========================
   LISTAR
========================= */

$cursos = CursoController::listarCursos();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$cursoEditar = $idEditar
? CursoController::obtenerCurso($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Cursos</title>
<link rel="icon" type="image/png" href="assets/img/logos/logo.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    background:#f4f7fc;
}

.card{
    border:none;
    border-radius:15px;
}

.table img{
    object-fit:cover;
}

</style>

</head>

<body>

<div class="container-fluid p-4">

    <!-- HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <a href="index.php?ruta=dashboard" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>

        <div class="text-end">
            <h2 class="fw-bold mb-0">📚 Cursos</h2>
            <small class="text-secondary">
                Administración de cursos CEPRE
            </small>
        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($cursoEditar): ?>
                        <i class="fa-solid fa-pen"></i>
                        Editar Curso
                    <?php else: ?>
                        <i class="fa-solid fa-book"></i>
                        Registrar Curso
                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($cursoEditar): ?>

                            <input type="hidden" name="idCurso"
                            value="<?= $cursoEditar["idCurso"] ?>">

                            <input type="hidden" name="accion"
                            value="actualizar">

                        <?php else: ?>

                            <input type="hidden" name="accion"
                            value="guardar">

                        <?php endif; ?>

                        <!-- NOMBRE -->

                        <div class="mb-3">

                            <label class="form-label">
                                Nombre del Curso
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                class="form-control"
                                required
                                value="<?= $cursoEditar["nombre"] ?? '' ?>"
                            >

                        </div>

                        <!-- DESCRIPCION -->

                        <div class="mb-3">

                            <label class="form-label">
                                Descripción
                            </label>

                            <textarea
                                name="descripcion"
                                class="form-control"
                                rows="4"
                                required
                            ><?= $cursoEditar["descripcion"] ?? '' ?></textarea>

                        </div>

                        <!-- CREDITOS -->

                        <div class="mb-3">

                            <label class="form-label">
                                Créditos
                            </label>

                            <input
                                type="number"
                                name="creditos"
                                class="form-control"
                                required
                                value="<?= $cursoEditar["creditos"] ?? '' ?>"
                            >

                        </div>

                        <!-- ESTADO -->

                        <div class="mb-4">

                            <label class="form-label">
                                Estado
                            </label>

                            <select name="estado" class="form-select">

                                <option value="activo">
                                    Activo
                                </option>

                                <option value="inactivo">
                                    Inactivo
                                </option>

                            </select>

                        </div>

                        <!-- BOTONES -->

                        <?php if($cursoEditar): ?>

                            <button class="btn btn-warning w-100">
                                <i class="fa-solid fa-pen"></i>
                                Actualizar
                            </button>

                            <a href="index.php?ruta=curso"
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
                    Lista de Cursos

                </div>

                <div class="card-body">

                    <!-- BUSCADOR -->

                    <div class="mb-3">

                        <input
                            type="text"
                            id="buscarCurso"
                            class="form-control"
                            placeholder="Buscar curso..."
                        >

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle text-center"
                        id="tablaCursos">

                            <thead class="table-primary">

                                <tr>

                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Descripción</th>
                                    <th>Créditos</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($cursos as $c): ?>

                                <tr>

                                    <td><?= $c["idCurso"] ?></td>

                                    <td>
                                        <strong>
                                            <?= $c["nombre"] ?>
                                        </strong>
                                    </td>

                                    <td><?= $c["descripcion"] ?></td>

                                    <td>

                                        <span class="badge bg-info">
                                            <?= $c["creditos"] ?>
                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge bg-<?= $c["estado"] == 'activo' ? 'success' : 'danger' ?>">

                                            <?= $c["estado"] ?>

                                        </span>

                                    </td>

                                    <td>

                                        <a
                                            href="index.php?ruta=curso&idEditar=<?= $c["idCurso"] ?>"
                                            class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                            href="index.php?ruta=curso&eliminar=<?= $c["idCurso"] ?>"
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

<script>

document.getElementById("buscarCurso")
.addEventListener("input", function(){

    let valor = this.value.toLowerCase();

    let filas = document.querySelectorAll("#tablaCursos tbody tr");

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