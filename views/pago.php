<?php
require_once "config/Conexion.php";
require_once "model/Pago.php";
require_once "model/Estudiante.php";
require_once "controller/PagoController.php";
require_once "controller/EstudianteController.php";

// Lógica de procesamiento
if(isset($_POST["accion"]) && $_POST["accion"]=="guardar"){
    PagoController::registrarPago($_POST);
    header("Location:index.php?ruta=pago"); exit;
}
if(isset($_POST["accion"]) && $_POST["accion"]=="actualizar"){
    PagoController::actualizarPago($_POST);
    header("Location:index.php?ruta=pago"); exit;
}
if(isset($_GET["eliminar"])){
    PagoController::eliminarPago($_GET["eliminar"]);
    header("Location:index.php?ruta=pago"); exit;
}

$pagos = PagoController::listarPagos();
$estudiantes = EstudianteController::listarEstudiantes();
$idEditar = $_GET["idEditar"] ?? null;
$pagoEditar = $idEditar ? PagoController::obtenerPago($idEditar) : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pagos</title>
    <link rel="icon" type="image/png" href="assets/img/logos/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilos_pagos.css"> 
</head>

<body class="bg-light">

<div class="container-fluid px-4 py-4">

    <div class="d-flex align-items-center mb-4">
        <a href="index.php?ruta=dashboard" class="btn-volver-custom btn-secundario me-4 text-white">
            <i class="fa-solid fa-arrow-left me-2"></i> Volver al Inicio
        </a>
        <h2 class="mb-0 fw-bold text-dark">
            <i class="fa-solid fa-money-bill-transfer text-success me-2"></i> Gestión de Pagos
        </h2>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="card-title mb-0 fw-bold text-primary">
                        <?= $pagoEditar ? '✏️ Editar Pago' : '➕ Registrar Nuevo Pago' ?>
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <input type="hidden" name="idPago" value="<?= $pagoEditar['idPago'] ?? '' ?>">
                        <input type="hidden" name="accion" value="<?= $pagoEditar ? 'actualizar' : 'guardar' ?>">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Estudiante</label>
                            <select name="idEstudiante" class="form-select form-select-lg shadow-none border-2" required>
                                <option value="">Seleccione estudiante</option>
                                <?php foreach($estudiantes as $e){ ?>
                                    <option value="<?= $e['idEstudiante'] ?>" <?= ($pagoEditar && $pagoEditar['idEstudiante']==$e['idEstudiante'])?'selected':'' ?>>
                                        <?= $e['nombres'] ?> <?= $e['apellidos'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Concepto de Pago</label>
                            <select name="concepto" class="form-select form-select-lg shadow-none border-2" required>
                                <option value="">-- Seleccione concepto --</option>
                                <option value="Matrícula" <?= ($pagoEditar && $pagoEditar['concepto']==='Matrícula')?'selected':'' ?>>Matrícula</option>
                                <option value="Mensualidad" <?= ($pagoEditar && $pagoEditar['concepto']==='Mensualidad')?'selected':'' ?>>Mensualidad</option>
                                <option value="Inscripción" <?= ($pagoEditar && $pagoEditar['concepto']==='Inscripción')?'selected':'' ?>>Inscripción</option>
                                <option value="Otros" <?= ($pagoEditar && $pagoEditar['concepto']==='Otros')?'selected':'' ?>>Otros</option>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Monto (S/)</label>
                                <input type="number" step="0.01" name="monto" class="form-control form-control-lg shadow-none border-2" placeholder="0.00" value="<?= $pagoEditar['monto'] ?? '' ?>" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold">Fecha</label>
                                <input type="date" name="fechaPago" class="form-control form-control-lg shadow-none border-2" value="<?= $pagoEditar['fechaPago'] ?? date('Y-m-d') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Método de Pago</label>
                            <select name="metodoPago" class="form-select form-select-lg shadow-none border-2">
                                <option <?= ($pagoEditar && $pagoEditar['metodoPago']=='Efectivo')?'selected':'' ?>>Efectivo</option>
                                <option <?= ($pagoEditar && $pagoEditar['metodoPago']=='Yape')?'selected':'' ?>>Yape</option>
                                <option <?= ($pagoEditar && $pagoEditar['metodoPago']=='Transferencia')?'selected':'' ?>>Transferencia</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Estado de Pago</label>
                            <select name="estado" class="form-select form-select-lg shadow-none border-2">
                                <option value="Pagado" class="text-success" <?= ($pagoEditar && $pagoEditar['estado']=='Pagado')?'selected':'' ?>>Pagado</option>
                                <option value="Pendiente" class="text-danger" <?= ($pagoEditar && $pagoEditar['estado']=='Pendiente')?'selected':'' ?>>Pendiente</option>
                            </select>
                        </div>

                        <button class="btn btn-primary btn-lg w-100 rounded-3 shadow py-2 fw-bold">
                            <i class="fa-solid fa-floppy-disk me-2"></i> <?= $pagoEditar ? 'ACTUALIZAR PAGO' : 'GUARDAR PAGO' ?>
                        </button>
                        
                        <?php if($pagoEditar): ?>
                            <a href="index.php?ruta=pago" class="btn btn-link w-100 text-decoration-none mt-2 text-secondary">Cancelar edición</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-pagos-header">
                                <tr>
                                    <th class="py-3 ps-4">ID</th>
                                    <th class="py-3">Estudiante</th>
                                    <th class="py-3">Concepto</th>
                                    <th class="py-3">Monto</th>
                                    <th class="py-3 text-center">Estado</th>
                                    <th class="py-3 text-center pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pagos as $p): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-muted">#<?= $p['idPago'] ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= mb_strtoupper($p['nombres']) ?> <?= mb_strtoupper($p['apellidos']) ?></div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border px-3"><?= $p['concepto'] ?></span></td>
                                    <td class="fw-bold text-success">S/ <?= number_format($p['monto'], 2) ?></td>
                                    <td class="text-center">
                                        <?php if($p['estado'] == 'Pagado'): ?>
                                            <span class="badge rounded-pill bg-success px-3">Pagado</span>
                                        <?php else: ?>
                                            <span class="badge rounded-pill bg-danger px-3">Pendiente</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4 text-nowrap">
                                        <a href="index.php?ruta=pago&idEditar=<?= $p['idPago'] ?>" class="btn btn-outline-warning btn-sm mx-1 rounded-2 shadow-sm" title="Editar">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="index.php?ruta=pago&eliminar=<?= $p['idPago'] ?>" class="btn btn-outline-danger btn-sm mx-1 rounded-2 shadow-sm" title="Eliminar" onclick="return confirm('¿Eliminar registro?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        <a href="views/pdf/pago.php?idPago=<?= $p['idPago'] ?>" target="_blank" class="btn btn-outline-dark btn-sm mx-1 rounded-2 shadow-sm" title="Imprimir Recibo">
                                            <i class="fa-solid fa-print"></i>
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