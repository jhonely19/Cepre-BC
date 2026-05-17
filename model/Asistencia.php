<?php
require_once "controller/AsistenciaController.php";
require_once "controller/CursoController.php";

// Procesar Guardado Masivo
if(isset($_POST["btnGuardar"])){
    foreach($_POST["estado"] as $idEstudiante => $estado){
        $data = [
            "idEstudiante" => $idEstudiante,
            "idCurso" => $_POST["idCurso"],
            "fecha" => $_POST["fecha"],
            "estado" => $estado
        ];
        AsistenciaController::guardarAsistencia($data);
    }
    echo "<script>alert('Asistencia guardada con éxito'); window.location='index.php?ruta=asistencia';</script>";
}

$cursos = CursoController::listarCursos();
$alumnos = (isset($_GET["idCurso"])) ? AsistenciaController::obtenerAlumnos($_GET["idCurso"]) : [];
?>

<style>
    :root {
        --primary: #005a44;
        --secondary: #009d71;
        --accent: #f9bc35;
        --bg-light: #f8faf9;
        --text-dark: #2c3e50;
    }

    body { background-color: var(--bg-light); color: var(--text-dark); }

    /* Estilo de la Tarjeta de Filtros */
    .filtros-container {
        background: #fff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border-left: 5px solid var(--secondary);
    }

    /* Cabecera Principal */
    .header-cepre-v2 {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        padding: 30px;
        border-radius: 20px 20px 0 0;
        position: relative;
        overflow: hidden;
    }

    .header-cepre-v2::after {
        content: "";
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 5px;
        background: var(--accent);
    }

    /* Tabla Estilizada */
    .table-modern {
        background: white;
        border-radius: 0 0 20px 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .table-modern thead th {
        background: #f1f4f3;
        color: #555;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 18px;
        border: none;
    }

    .table-modern tbody tr { transition: all 0.2s; border-bottom: 1px solid #eee; }
    .table-modern tbody tr:hover { background-color: #f0fdf4; transform: scale(1.002); }

    /* Botones de Radio Estilo "Switch" */
    .asistencia-options .btn {
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.7rem;
        padding: 8px 15px;
        margin: 0 3px;
        border-width: 2px;
        text-transform: uppercase;
    }

    .btn-outline-p { border-color: #27ae60; color: #27ae60; }
    .btn-check:checked + .btn-outline-p { background: #27ae60 !important; color: white; box-shadow: 0 4px 12px rgba(39,174,96,0.3); }

    .btn-outline-t { border-color: #f39c12; color: #f39c12; }
    .btn-check:checked + .btn-outline-t { background: #f39c12 !important; color: white; box-shadow: 0 4px 12px rgba(243,156,18,0.3); }

    .btn-outline-f { border-color: #e74c3c; color: #e74c3c; }
    .btn-check:checked + .btn-outline-f { background: #e74c3c !important; color: white; box-shadow: 0 4px 12px rgba(231,76,60,0.3); }

    /* Foto de Alumno con Efecto */
    .avatar-wrapper {
        width: 55px; height: 55px;
        padding: 3px;
        background: linear-gradient(45deg, var(--secondary), var(--accent));
        border-radius: 50%;
        display: inline-block;
    }
    .avatar-img {
        width: 100%; height: 100%;
        object-fit: cover;
        border-radius: 50%;
        background: white;
        border: 2px solid white;
    }

    /* Botón Flotante Guardar */
    .btn-save-float {
        background: var(--primary);
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 800;
        border: none;
        box-shadow: 0 8px 20px rgba(0,90,68,0.3);
        transition: all 0.3s;
    }
    .btn-save-float:hover {
        background: var(--secondary);
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0,90,68,0.4);
        color: white;
    }
</style>

<div class="container py-5">
    <div class="card filtros-container mb-5 p-4">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h5 class="fw-bold mb-3" style="color: var(--primary)"><i class="fa-solid fa-filter me-2"></i>Panel de Selección</h5>
                <form method="GET" class="row g-3">
                    <input type="hidden" name="ruta" value="asistencia">
                    <div class="col-sm-8">
                        <select name="idCurso" class="form-select form-select-lg border-0 shadow-sm" onchange="this.form.submit()" style="background-color: #f1f4f3;">
                            <option value="">Selecciona el curso a evaluar...</option>
                            <?php foreach($cursos as $c): ?>
                                <option value="<?= $c['idCurso'] ?>" <?= (isset($_GET['idCurso']) && $_GET['idCurso']==$c['idCurso'])?'selected':'' ?>><?= $c['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-5 text-end">
                <div class="p-3 rounded-4" style="background: #f1f4f3; display: inline-block;">
                    <span class="small fw-bold text-muted d-block mb-1">FECHA DE REGISTRO</span>
                    <h5 class="mb-0 fw-bold"><i class="fa-regular fa-calendar-check me-2"></i><?= date('d/m/Y') ?></h5>
                </div>
            </div>
        </div>
    </div>

    <?php if(!empty($alumnos)): ?>
    <form method="POST">
        <input type="hidden" name="idCurso" value="<?= $_GET['idCurso'] ?>">
        <input type="hidden" name="fecha" value="<?= $_GET['fecha'] ?? date('Y-m-d') ?>">

        <div class="table-modern">
            <div class="header-cepre-v2 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-0 fw-bolder">LISTA DE ASISTENCIA</h2>
                    <span class="opacity-75">Control académico CEPRE BC</span>
                </div>
                <i class="fa-solid fa-users-viewfinder fa-3x opacity-25"></i>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Perfil</th>
                            <th>Estudiante</th>
                            <th class="text-center">Estado de Asistencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($alumnos as $a): ?>
                        <tr>
                            <td class="text-center fw-bold text-muted small"><?= str_pad($i++, 2, "0", STR_PAD_LEFT) ?></td>
                            <td class="text-center">
                                <div class="avatar-wrapper">
                                    <img src="assets/img/estudiantes/<?= $a['foto'] ?>" class="avatar-img" onerror="this.src='assets/img/user.png'">
                                </div>
                            </td>
                            <td>
                                <div class="nombre-estudiante"><?= $a['apellidos'] ?>, <?= $a['nombres'] ?></div>
                                <div class="dni-estudiante"><i class="fa-solid fa-id-card me-1"></i><?= $a['dni'] ?></div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group asistencia-options" role="group">
                                    <input type="radio" class="btn-check" name="estado[<?= $a['idEstudiante'] ?>]" id="p<?= $a['idEstudiante'] ?>" value="Presente" checked>
                                    <label class="btn btn-outline-p" for="p<?= $a['idEstudiante'] ?>"><i class="fa-solid fa-circle-check me-1"></i> P</label>

                                    <input type="radio" class="btn-check" name="estado[<?= $a['idEstudiante'] ?>]" id="t<?= $a['idEstudiante'] ?>" value="Tardanza">
                                    <label class="btn btn-outline-t" for="t<?= $a['idEstudiante'] ?>"><i class="fa-solid fa-clock me-1"></i> T</label>

                                    <input type="radio" class="btn-check" name="estado[<?= $a['idEstudiante'] ?>]" id="f<?= $a['idEstudiante'] ?>" value="Falta">
                                    <label class="btn btn-outline-f" for="f<?= $a['idEstudiante'] ?>"><i class="fa-solid fa-circle-xmark me-1"></i> F</label>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="text-center py-5 bg-light">
                <button type="submit" name="btnGuardar" class="btn-save-float">
                    <i class="fa-solid fa-floppy-disk me-2"></i> FINALIZAR Y GUARDAR REGISTRO
                </button>
            </div>
        </div>
    </form>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="fa-solid fa-layer-group fa-4x text-muted mb-3 opacity-25"></i>
            <h5 class="text-muted">Selecciona un curso para cargar los alumnos matriculados</h5>
        </div>
    <?php endif; ?>
</div>