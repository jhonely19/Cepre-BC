<?php

require_once "config/Conexion.php";
require_once "model/Aula.php";
require_once "controller/AulaController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar") {

    $data = [

        "nombre" => $_POST["nombre"],
        "capacidad" => $_POST["capacidad"],
        "ubicacion" => $_POST["ubicacion"]

    ];

    AulaController::registrarAula($data);

    header("Location: index.php?ruta=aula");

    exit;
}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "actualizar") {

    $data = [

        "idAula" => $_POST["idAula"],
        "nombre" => $_POST["nombre"],
        "capacidad" => $_POST["capacidad"],
        "ubicacion" => $_POST["ubicacion"]

    ];

    AulaController::actualizarAula($data);

    header("Location: index.php?ruta=aula");

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    AulaController::eliminarAula($_GET["eliminar"]);

    header("Location: index.php?ruta=aula");

    exit;
}

/* =========================
   LISTAR
========================= */

$aulas = AulaController::listarAulas();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$aulaEditar = $idEditar
? AulaController::obtenerAula($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Aulas</title>

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
                🏫 Aulas
            </h2>

            <small class="text-secondary">
                Administración de aulas CEPRE
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($aulaEditar): ?>

                        <i class="fa-solid fa-pen"></i>
                        Editar Aula

                    <?php else: ?>

                        <i class="fa-solid fa-school"></i>
                        Registrar Aula

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($aulaEditar): ?>

                            <input
                                type="hidden"
                                name="idAula"
                                value="<?= $aulaEditar["idAula"] ?>"
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
                                Nombre del Aula
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                class="form-control"
                                required
                                value="<?= $aulaEditar["nombre"] ?? '' ?>"
                            >

                        </div>

                        <!-- CAPACIDAD -->

                        <div class="mb-3">

                            <label class="form-label">
                                Capacidad
                            </label>

                            <input
                                type="number"
                                name="capacidad"
                                class="form-control"
                                required
                                value="<?= $aulaEditar["capacidad"] ?? '' ?>"
                            >

                        </div>

                        <!-- UBICACION -->

                        <div class="mb-4">

                            <label class="form-label">
                                Ubicación
                            </label>

                            <input
                                type="text"
                                name="ubicacion"
                                class="form-control"
                                required
                                value="<?= $aulaEditar["ubicacion"] ?? '' ?>"
                            >

                        </div>

                        <!-- BOTONES -->

                        <?php if($aulaEditar): ?>

                            <button class="btn btn-warning w-100">

                                <i class="fa-solid fa-pen"></i>
                                Actualizar

                            </button>

                            <a href="index.php?ruta=aula"
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
                    Lista de Aulas

                </div>

                <div class="card-body">

                    <!-- BUSCADOR -->

                    <div class="mb-3">

                        <input
                            type="text"
                            id="buscarAula"
                            class="form-control"
                            placeholder="Buscar aula..."
                        >

                    </div>

                    <div class="table-responsive">

                        <table
                            class="table table-hover align-middle text-center"
                            id="tablaAulas"
                        >

                            <thead class="table-primary">

                                <tr>

                                    <th>ID</th>
                                    <th>Aula</th>
                                    <th>Capacidad</th>
                                    <th>Ubicación</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($aulas as $a): ?>

                                <tr>

                                    <td><?= $a["idAula"] ?></td>

                                    <td>
                                        <strong>
                                            <?= $a["nombre"] ?>
                                        </strong>
                                    </td>

                                    <td>

                                        <span class="badge bg-info">
                                            <?= $a["capacidad"] ?>
                                            alumnos
                                        </span>

                                    </td>

                                    <td><?= $a["ubicacion"] ?></td>

                                    <td>

                                        <a
                                            href="index.php?ruta=aula&idEditar=<?= $a["idAula"] ?>"
                                            class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                            href="index.php?ruta=aula&eliminar=<?= $a["idAula"] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar aula?')"
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

document.getElementById("buscarAula")
.addEventListener("input", function(){

    let valor = this.value.toLowerCase();

    let filas = document.querySelectorAll("#tablaAulas tbody tr");

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