<?php

require_once "config/Conexion.php";

require_once "model/Comprobante.php";
require_once "model/Pago.php";

require_once "controller/ComprobanteController.php";
require_once "controller/PagoController.php";

/* =========================
   GUARDAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "guardar"){

    $data = [

        "idPago" => $_POST["idPago"],
        "tipo" => $_POST["tipo"],
        "serie" => $_POST["serie"],
        "correlativo" => $_POST["correlativo"]

    ];

    ComprobanteController::registrarComprobante($data);

    header("Location:index.php?ruta=comprobante");

    exit;

}

/* =========================
   ACTUALIZAR
========================= */

if(isset($_POST["accion"]) &&
$_POST["accion"] == "actualizar"){

    $data = [

        "idComprobante" => $_POST["idComprobante"],
        "idPago" => $_POST["idPago"],
        "tipo" => $_POST["tipo"],
        "serie" => $_POST["serie"],
        "correlativo" => $_POST["correlativo"]

    ];

    ComprobanteController::actualizarComprobante($data);

    header("Location:index.php?ruta=comprobante");

    exit;

}

/* =========================
   ELIMINAR
========================= */

if(isset($_GET["eliminar"])){

    ComprobanteController::eliminarComprobante(
    $_GET["eliminar"]
    );

    header("Location:index.php?ruta=comprobante");

    exit;

}

/* =========================
   LISTAR
========================= */

$comprobantes =
ComprobanteController::listarComprobantes();

$pagos = PagoController::listarPagos();

/* =========================
   EDITAR
========================= */

$idEditar = $_GET["idEditar"] ?? null;

$comprobanteEditar = $idEditar
? ComprobanteController::obtenerComprobante($idEditar)
: null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Comprobantes</title>
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
                🧾 Comprobantes
            </h2>

            <small class="text-secondary">
                Gestión de comprobantes CEPRE
            </small>

        </div>

    </div>

    <div class="row g-4">

        <!-- FORMULARIO -->

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <?php if($comprobanteEditar): ?>

                        Editar Comprobante

                    <?php else: ?>

                        Registrar Comprobante

                    <?php endif; ?>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <?php if($comprobanteEditar): ?>

                            <input
                            type="hidden"
                            name="idComprobante"
                            value="<?= $comprobanteEditar["idComprobante"] ?>"
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

                        <!-- PAGO -->

                        <div class="mb-3">

                            <label>
                                Pago
                            </label>

                            <select
                            name="idPago"
                            class="form-select"
                            required
                            >

                                <option value="">
                                    Seleccione pago
                                </option>

                                <?php foreach($pagos as $p): ?>

                                    <option
                                    value="<?= $p["idPago"] ?>"
                                    <?= ($comprobanteEditar &&
                                    $comprobanteEditar["idPago"] ==
                                    $p["idPago"])
                                    ? 'selected' : '' ?>
                                    >

                                        <?= $p["nombres"] ?>
                                        <?= $p["apellidos"] ?>
                                        -
                                        <?= $p["concepto"] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- TIPO -->

                        <div class="mb-3">

                            <label>
                                Tipo
                            </label>

                            <?php

                            $tipo =
                            $comprobanteEditar["tipo"] ?? "";

                            ?>

                            <select
                            name="tipo"
                            class="form-select"
                            required
                            >

                                <option value="">
                                    Seleccione
                                </option>

                                <option value="Boleta"
                                <?= ($tipo=="Boleta")
                                ? 'selected' : '' ?>>
                                    Boleta
                                </option>

                                <option value="Recibo"
                                <?= ($tipo=="Recibo")
                                ? 'selected' : '' ?>>
                                    Recibo
                                </option>

                            </select>

                        </div>

                        <!-- SERIE -->

                        <div class="mb-3">

                            <label>
                                Serie
                            </label>

                            <input
                            type="text"
                            name="serie"
                            class="form-control"
                            required
                            value="<?= $comprobanteEditar["serie"] ?? '' ?>"
                            >

                        </div>

                        <!-- CORRELATIVO -->

                        <div class="mb-4">

                            <label>
                                Correlativo
                            </label>

                            <input
                            type="text"
                            name="correlativo"
                            class="form-control"
                            required
                            value="<?= $comprobanteEditar["correlativo"] ?? '' ?>"
                            >

                        </div>

                        <!-- BOTON -->

                        <button
                        class="btn btn-primary w-100"
                        >

                            <i class="fa-solid fa-floppy-disk"></i>

                            <?= $comprobanteEditar
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
                    Lista de Comprobantes

                </div>

                <div class="card-body">

                    <!-- BUSCADOR -->

                    <div class="mb-3">

                        <input
                        type="text"
                        id="buscarComprobante"
                        class="form-control"
                        placeholder="Buscar comprobante..."
                        >

                    </div>

                    <div class="table-responsive">

                        <table
                        class="table table-hover align-middle"
                        id="tablaComprobantes"
                        >

                            <thead class="table-primary">

                                <tr>

                                    <th>ID</th>
                                    <th>Estudiante</th>
                                    <th>Tipo</th>
                                    <th>Serie</th>
                                    <th>Correlativo</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach($comprobantes as $c): ?>

                                <tr>

                                    <td>
                                        <?= $c["idComprobante"] ?>
                                    </td>

                                    <td>

                                        <?= $c["nombres"] ?>
                                        <?= $c["apellidos"] ?>

                                    </td>

                                    <td>

                                        <span class="badge bg-primary">

                                            <?= $c["tipo"] ?>

                                        </span>

                                    </td>

                                    <td>
                                        <?= $c["serie"] ?>
                                    </td>

                                    <td>
                                        <?= $c["correlativo"] ?>
                                    </td>

                                    <td>
                                        <?= $c["fecha"] ?>
                                    </td>

                                    <td>

                                        <a
                                        href="index.php?ruta=comprobante&idEditar=<?= $c["idComprobante"] ?>"
                                        class="btn btn-warning btn-sm"
                                        >

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a
                                        href="index.php?ruta=comprobante&eliminar=<?= $c["idComprobante"] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar comprobante?')"
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

document.getElementById("buscarComprobante")
.addEventListener("input", function(){

    let valor = this.value.toLowerCase();

    let filas = document.querySelectorAll(
    "#tablaComprobantes tbody tr"
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