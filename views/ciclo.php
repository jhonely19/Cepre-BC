<?php

require_once "config/Conexion.php";

require_once "model/Ciclo.php";

require_once "controller/CicloController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "guardar") {

    $data = [

        "nombre" => $_POST["nombre"],
        "fechaInicio" => $_POST["fechaInicio"],
        "fechaFin" => $_POST["fechaFin"],
        "estado" => $_POST["estado"]

    ];

    CicloController::registrarCiclo($data);

    header("Location:index.php?ruta=ciclo");

    exit;
}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) && $_POST["accion"] == "actualizar") {

    $data = [

        "idCiclo" => $_POST["idCiclo"],
        "nombre" => $_POST["nombre"],
        "fechaInicio" => $_POST["fechaInicio"],
        "fechaFin" => $_POST["fechaFin"],
        "estado" => $_POST["estado"]

    ];

    CicloController::actualizarCiclo($data);

    header("Location:index.php?ruta=ciclo");

    exit;
}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])) {

    CicloController::eliminarCiclo($_GET["eliminar"]);

    header("Location:index.php?ruta=ciclo");

    exit;
}

/* =========================
   LISTAR
========================= */

$ciclos = CicloController::listarCiclos();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$cicloEditar = $idEditar
? CicloController::obtenerCiclo($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Ciclos</title>

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
                📅 Ciclos
            </h2>

            <small class="text-secondary">
                Administración de ciclos CEPRE
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($cicloEditar): ?>

                        <i class="fa-solid fa-pen"></i>
                        Editar Ciclo

                    <?php else: ?>

                        <i class="fa-solid fa-calendar"></i>
                        Registrar Ciclo

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($cicloEditar): ?>

                            <input
                                type="hidden"
                                name="idCiclo"
                                value="<?= $cicloEditar["idCiclo"] ?>"
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
                                Nombre del Ciclo
                            </label>

                            <input
                                type="text"
                                name="nombre"
                                class="form-control"
                                required
                                value="<?= $cicloEditar["nombre"] ?? '' ?>"
                            >

                        </div>

                        <!-- FECHA INICIO -->

                        <div class="mb-3">

                            <label class="form-label">
                                Fecha Inicio
                            </label>

                            <input
                                type="date"
                                name="fechaInicio"
                                class="form-control"
                                required
                                value="<?= $cicloEditar["fechaInicio"] ?? '' ?>"
                            >

                        </div>

                        <!-- FECHA FIN -->

                        <div class="mb-3">

                            <label class="form-label">
                                Fecha Fin
                            </label>

                            <input
                                type="date"
                                name="fechaFin"
                                class="form-control"
                                required
                                value="<?= $cicloEditar["fechaFin"] ?? '' ?>"
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

                                <option value="activo"
                                <?= ($cicloEditar &&
                                $cicloEditar["estado"]=="activo")
                                ? 'selected' : '' ?>>

                                    Activo

                                </option>

                                <option value="finalizado"
                                <?= ($cicloEditar &&
                                $cicloEditar["estado"]=="finalizado")
                                ? 'selected' : '' ?>>

                                    Finalizado

                                </option>

                            </select>

                        </div>

                        <!-- BOTONES -->

                        <?php if($cicloEditar): ?>

                            <button class="btn btn-warning w-100">

                                <i class="fa-solid fa-pen"></i>
                                Actualizar

                            </button>

                            <a href="index.php?ruta=ciclo"
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
                    Lista de Ciclos

                </div>

                <div class="card-body">

                    <!-- BUSCADOR -->

                    <div class="mb-3">

                        <input
                            type="text"
                            id="buscarCiclo"
                            class="form-control"
                            placeholder="Buscar ciclo..."
                        >

                    </div>

                    <div class="table-responsive">

                        <table
                            class="table table-hover align-middle text-center"
                            id="tablaCiclos"
                        >

                            <thead class="table-primary">

                                <tr>

                                    <th>ID</th>
                                    <th>Ciclo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($ciclos as $c): ?>

                                <tr>

                                    <td><?= $c["idCiclo"] ?></td>

                                    <td>

                                        <strong>
                                            <?= $c["nombre"] ?>
                                        </strong>

                                    </td>

                                    <td><?= $c["fechaInicio"] ?></td>

                                    <td><?= $c["fechaFin"] ?></td>

                                    <td>

                                        <span class="badge bg-<?= $c["estado"] == 'activo' ? 'success' : 'danger' ?>">

                                            <?= $c["estado"] ?>

                                        </span>

                                    </td>

                                    <td>

                                        <a
                                            href="index.php?ruta=ciclo&idEditar=<?= $c["idCiclo"] ?>"
                                            class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                            href="index.php?ruta=ciclo&eliminar=<?= $c["idCiclo"] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar ciclo?')"
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

document.getElementById("buscarCiclo")
.addEventListener("input", function(){

    let valor = this.value.toLowerCase();

    let filas = document.querySelectorAll("#tablaCiclos tbody tr");

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