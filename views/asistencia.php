<?php
require_once "controller/AsistenciaController.php";
require_once "controller/CursoController.php";

// Procesar Guardado Masivo
if(isset($_POST["btnGuardar"])){
    if(isset($_POST["estado"]) && is_array($_POST["estado"])){
        foreach($_POST["estado"] as $idEstudiante => $estado){
            $data = [
                "idEstudiante" => $idEstudiante,
                "idCurso" => $_POST["idCurso"],
                "fecha" => $_POST["fecha"],
                "estado" => $estado
            ];
            AsistenciaController::guardarAsistencia($data);
        }
        echo "<script>alert('Se guardó asistencia correctamente'); window.location='index.php?ruta=asistencia';</script>";
    }
}

$cursos = CursoController::listarCursos();
$idCursoSeleccionado = $_GET["idCurso"] ?? '';
$fechaSeleccionada = $_GET["fecha"] ?? date('Y-m-d');
$alumnos = (!empty($idCursoSeleccionado)) ? AsistenciaController::obtenerAlumnos($idCursoSeleccionado) : [];
?>

<link rel="stylesheet" href="assets/css/stylos_asistencia.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid p-4">
    <div class="asistencia-container">
        
        <div class="card filtros-card mb-4">
            <div class="card-body py-3">
                <div class="row g-3 justify-content-center align-items-center">
                    <div class="col-md-5 d-flex align-items-center">
                        <label class="label-filtro">CURSO ACADÉMICO:</label>
                        <form method="GET" class="w-100">
                            <input type="hidden" name="ruta" value="asistencia">
                            <input type="hidden" name="fecha" value="<?= $fechaSeleccionada ?>">
                            <select name="idCurso" class="form-select form-select-custom shadow-sm" onchange="this.form.submit()">
                                <option value="">--- Elija un curso ---</option>
                                <?php foreach($cursos as $c): ?>
                                    <option value="<?= $c['idCurso'] ?>" <?= ($idCursoSeleccionado == $c['idCurso']) ? 'selected' : '' ?>>
                                        <?= $c['nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </div>

                    <div class="col-md-4 d-flex align-items-center">
                        <label class="label-filtro">FECHA DE CLASE:</label>
                        <form method="GET" class="w-100">
                            <input type="hidden" name="ruta" value="asistencia">
                            <input type="hidden" name="idCurso" value="<?= $idCursoSeleccionado ?>">
                            <input type="date" name="fecha" class="form-control form-control-custom shadow-sm" value="<?= $fechaSeleccionada ?>" onchange="this.form.submit()">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!empty($alumnos)): ?>
        <form method="POST">
            <input type="hidden" name="idCurso" value="<?= $idCursoSeleccionado ?>">
            <input type="hidden" name="fecha" value="<?= $fechaSeleccionada ?>">

            <div class="card card-main">
                <div class="header-cepre">
                    <h1 class="m-0 text-white text-center">CONTROL DE ASISTENCIA</h1>
                </div>
                
                <div class="table-responsive">
                    <table class="asistencia-table w-100">
                        <thead>
                            <tr class="text-center">
                                <th width="70">#</th>
                                <th width="100">PERFIL</th>
                                <th class="text-start">ESTUDIANTE (APELLIDOS Y NOMBRES)</th>
                                <th>MARCAR ASISTENCIA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($alumnos as $a): ?>
                            <tr>
                                <td class="text-center row-number"><?= $i++ ?></td>
                                <td class="text-center">
                                    <img src="assets/img/estudiantes/<?= $a['foto'] ?>" class="foto-perfil" onerror="this.src='assets/img/user.png'">
                                </td>
                                <td>
                                    <div class="nombre-estudiante"><?= mb_strtoupper($a['apellidos']) ?>, <?= mb_strtoupper($a['nombres']) ?></div>
                                </td>
                                <td>
                                    <div class="btn-group-asistencia d-flex justify-content-center gap-2">
                                        <label class="m-0">
                                            <input type="radio" class="input-check" name="estado[<?= $a['idEstudiante'] ?>]" value="Presente" required>
                                            <div class="btn-asist btn-presente">
                                                <i class="fa-solid fa-check-circle"></i>
                                                <span>Presente</span>
                                            </div>
                                        </label>

                                        <label class="m-0">
                                            <input type="radio" class="input-check" name="estado[<?= $a['idEstudiante'] ?>]" value="Tardanza">
                                            <div class="btn-asist btn-tardanza">
                                                <i class="fa-solid fa-clock"></i>
                                                <span>Tardanza</span>
                                            </div>
                                        </label>

                                        <label class="m-0">
                                            <input type="radio" class="input-check" name="estado[<?= $a['idEstudiante'] ?>]" value="Falta">
                                            <div class="btn-asist btn-falta">
                                                <i class="fa-solid fa-times-circle"></i>
                                                <span>Faltó</span>
                                            </div>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer footer-save d-flex gap-3 flex-wrap justify-content-center py-4">
                    <button type="submit" name="btnGuardar" class="btn-guardar-pro shadow">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i> GUARDAR ASISTENCIA DEL DÍA
                    </button>

                    <a class="btn-volver-custom btn-secundario" href="index.php?ruta=dashboard">
                        <i class="fa-solid fa-arrow-left me-2"></i> Volver
                    </a>
                </div>
            </div>
        </form>
        <?php else: ?>
            <div class="alert alert-info text-center shadow-sm" style="border-radius:15px;">
                <i class="fa-solid fa-circle-info me-2"></i> Por favor, seleccione un curso para listar a los estudiantes.
            </div>
        <?php endif; ?>
    </div>
</div>