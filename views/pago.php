<?php

require_once "config/Conexion.php";

require_once "model/Pago.php";
require_once "model/Estudiante.php";

require_once "controller/PagoController.php";
require_once "controller/EstudianteController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "guardar"){

    $data = [

        "idEstudiante" => $_POST["idEstudiante"],
        "concepto" => $_POST["concepto"],
        "monto" => $_POST["monto"],
        "fechaPago" => $_POST["fechaPago"],
        "metodoPago" => $_POST["metodoPago"],
        "estado" => $_POST["estado"]

    ];

    PagoController::registrarPago($data);

    header("Location:index.php?ruta=pago");

    exit;

}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "actualizar"){

    $data = [

        "idPago" => $_POST["idPago"],
        "idEstudiante" => $_POST["idEstudiante"],
        "concepto" => $_POST["concepto"],
        "monto" => $_POST["monto"],
        "fechaPago" => $_POST["fechaPago"],
        "metodoPago" => $_POST["metodoPago"],
        "estado" => $_POST["estado"]

    ];

    PagoController::actualizarPago($data);

    header("Location:index.php?ruta=pago");

    exit;

}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])){

    PagoController::eliminarPago($_GET["eliminar"]);

    header("Location:index.php?ruta=pago");

    exit;

}

/* =========================
   LISTAR
========================= */

$pagos = PagoController::listarPagos();

$estudiantes = EstudianteController::listarEstudiantes();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$pagoEditar = $idEditar
? PagoController::obtenerPago($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Pagos</title>

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
                💰 Pagos
            </h2>

            <small class="text-secondary">
                Gestión de pagos CEPRE
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($pagoEditar): ?>

                        Editar Pago

                    <?php else: ?>

                        Registrar Pago

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($pagoEditar): ?>

                            <input
                            type="hidden"
                            name="idPago"
                            value="<?= $pagoEditar["idPago"] ?>"
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

                            <label>
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
                                    <?= ($pagoEditar &&
                                    $pagoEditar["idEstudiante"] ==
                                    $e["idEstudiante"])
                                    ? 'selected' : '' ?>
                                    >

                                        <?= $e["nombres"] ?>
                                        <?= $e["apellidos"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- CONCEPTO -->

                        <div class="mb-3">

                            <label>
                                Concepto
                            </label>

                            <select
                            name="concepto"
                            class="form-select"
                            required
                            >

                                <?php

                                $concepto =
                                $pagoEditar["concepto"] ?? "";

                                ?>

                                <option value="">
                                    Seleccione
                                </option>

                                <option value="Inscripción"
                                <?= ($concepto=="Inscripción")
                                ? 'selected' : '' ?>>
                                    Inscripción
                                </option>

                                <option value="Mensualidad"
                                <?= ($concepto=="Mensualidad")
                                ? 'selected' : '' ?>>
                                    Mensualidad
                                </option>

                                <option value="Examen"
                                <?= ($concepto=="Examen")
                                ? 'selected' : '' ?>>
                                    Examen
                                </option>

                            </select>

                        </div>

                        <!-- MONTO -->

                        <div class="mb-3">

                            <label>
                                Monto
                            </label>

                            <input
                            type="number"
                            step="0.01"
                            name="monto"
                            class="form-control"
                            required
                            value="<?= $pagoEditar["monto"] ?? '' ?>"
                            >

                        </div>

                        <!-- FECHA -->

                        <div class="mb-3">

                            <label>
                                Fecha
                            </label>

                            <input
                            type="date"
                            name="fechaPago"
                            class="form-control"
                            required
                            value="<?= $pagoEditar["fechaPago"] ?? date("Y-m-d") ?>"
                            >

                        </div>

                        <!-- METODO -->

                        <div class="mb-3">

                            <label>
                                Método Pago
                            </label>

                            <select
                            name="metodoPago"
                            class="form-select"
                            required
                            >

                                <?php

                                $metodo =
                                $pagoEditar["metodoPago"] ?? "";

                                ?>

                                <option value="">
                                    Seleccione
                                </option>

                                <option value="Efectivo"
                                <?= ($metodo=="Efectivo")
                                ? 'selected' : '' ?>>
                                    Efectivo
                                </option>

                                <option value="Yape"
                                <?= ($metodo=="Yape")
                                ? 'selected' : '' ?>>
                                    Yape
                                </option>

                                <option value="Transferencia"
                                <?= ($metodo=="Transferencia")
                                ? 'selected' : '' ?>>
                                    Transferencia
                                </option>

                            </select>

                        </div>

                        <!-- ESTADO -->

                        <div class="mb-4">

                            <label>
                                Estado
                            </label>

                            <select
                            name="estado"
                            class="form-select"
                            required
                            >

                                <?php

                                $estado =
                                $pagoEditar["estado"] ?? "";

                                ?>

                                <option value="Pagado"
                                <?= ($estado=="Pagado")
                                ? 'selected' : '' ?>>
                                    Pagado
                                </option>

                                <option value="Pendiente"
                                <?= ($estado=="Pendiente")
                                ? 'selected' : '' ?>>
                                    Pendiente
                                </option>

                            </select>

                        </div>

                        <!-- BOTON -->

                        <button
                        class="btn btn-primary w-100"
                        >

                            <i class="fa-solid fa-floppy-disk"></i>

                            <?= $pagoEditar
                            ? 'Actualizar'
                            : 'Guardar' ?>

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
                    Lista de Pagos

                </div>

                <div class="card-body">

                    <!-- BUSCADOR -->

                    <div class="mb-3">

                        <input
                        type="text"
                        id="buscarPago"
                        class="form-control"
                        placeholder="Buscar pago..."
                        >

                    </div>

                    <div class="table-responsive">

                        <table
                        class="table table-hover align-middle"
                        id="tablaPagos"
                        >

                            <thead class="table-primary">

                                <tr>

                                    <th>ID</th>
                                    <th>Estudiante</th>
                                    <th>Concepto</th>
                                    <th>Monto</th>
                                    <th>Método</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($pagos as $p): ?>

                                <tr>

                                    <td>
                                        <?= $p["idPago"] ?>
                                    </td>

                                    <td>

                                        <?= $p["nombres"] ?>
                                        <?= $p["apellidos"] ?>

                                    </td>

                                    <td>
                                        <?= $p["concepto"] ?>
                                    </td>

                                    <td>

                                        S/
                                        <?= number_format($p["monto"],2) ?>

                                    </td>

                                    <td>
                                        <?= $p["metodoPago"] ?>
                                    </td>

                                    <td>

                                        <span class="badge bg-<?= $p["estado"] == 'Pagado' ? 'success' : 'danger' ?>">

                                            <?= $p["estado"] ?>

                                        </span>

                                    </td>

                                    <td>

                                        <a
                                        href="index.php?ruta=pago&idEditar=<?= $p["idPago"] ?>"
                                        class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                        href="index.php?ruta=pago&eliminar=<?= $p["idPago"] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar pago?')"
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

document.getElementById("buscarPago")
.addEventListener("input", function(){

    let valor = this.value.toLowerCase();

    let filas = document.querySelectorAll(
    "#tablaPagos tbody tr"
    );

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