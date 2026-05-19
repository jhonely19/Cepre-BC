<?php
require_once "config/Conexion.php";
require_once "model/Apoderado.php";
require_once "controller/ApoderadoController.php";
require_once "controller/EstudianteController.php";

/* =========================
   GUARDAR APODERADO
========================= */
if (isset($_POST["accion"]) && $_POST["accion"] == "guardar") {
    $data = [
        "idEstudiante" => $_POST["idEstudiante"],
        "nombres" => $_POST["nombres"],
        "apellidos" => $_POST["apellidos"],
        "telefono" => $_POST["telefono"],
        "parentesco" => $_POST["parentesco"],
        "direccion" => $_POST["direccion"]
    ];

    ApoderadoController::registrarApoderado($data);
    header("Location: index.php?ruta=apoderado");
    exit;
}

/* =========================
   ACTUALIZAR APODERADO
========================= */
if (isset($_POST["accion"]) && $_POST["accion"] == "actualizar") {
    $data = [
        "idApoderado" => $_POST["idApoderado"],
        "idEstudiante" => $_POST["idEstudiante"],
        "nombres" => $_POST["nombres"],
        "apellidos" => $_POST["apellidos"],
        "telefono" => $_POST["telefono"],
        "parentesco" => $_POST["parentesco"],
        "direccion" => $_POST["direccion"]
    ];

    ApoderadoController::actualizarApoderado($data);
    header("Location: index.php?ruta=apoderado");
    exit;
}

/* =========================
   ELIMINAR APODERADO
========================= */
if (isset($_GET["eliminar"])) {
    ApoderadoController::eliminarApoderado($_GET["eliminar"]);
    header("Location: index.php?ruta=apoderado");
    exit;
}

/* =========================
   LISTAR
========================= */
$apoderados = ApoderadoController::listarApoderados();
$estudiantes = EstudianteController::listarEstudiantes();

/* =========================
   EDITAR (GET)
========================= */
$idEditar = isset($_GET["idEditar"]) ? $_GET["idEditar"] : null;
$apoderEditar = $idEditar ? ApoderadoController::obtenerApoderado($idEditar) : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Apoderados</title>
    <link rel="icon" type="image/png" href="assets/img/logos/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body style="background:#f4f7fc;">
<div class="container-fluid p-4">

    <div class="mb-4 d-flex align-items-center justify-content-between">
        <a href="index.php?ruta=dashboard" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>
        <div class="text-end">
            <h2 class="fw-bold mb-0">Apoderados</h2>
            <p class="text-secondary mb-0">Administra los apoderados</p>
        </div>
    </div>


    <div class="row g-4 mb-5">

        <!-- IZQUIERDA: REGISTRO/EDICIÓN -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary text-white p-3 rounded-top-4">
                    <h4 class="mb-0">
                        <?php if($apoderEditar): ?>
                            <i class="fa-solid fa-pen"></i>
                            Editar Apoderado
                        <?php else: ?>
                            <i class="fa-solid fa-user-plus"></i>
                            Registrar Apoderado
                        <?php endif; ?>
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST">
                        <input type="hidden" name="accion" value="guardar">

                        <div class="mb-3">
                            <label class="form-label">Estudiante</label>
                            <select name="idEstudiante" class="form-select" required>
                                <option value="">Seleccione estudiante</option>
                                <?php foreach($estudiantes as $e): ?>
                                    <option value="<?= $e['idEstudiante'] ?>"
                                        <?= ($apoderEditar && $apoderEditar['idEstudiante']==$e['idEstudiante']) ? 'selected' : '' ?> >
                                        <?= $e['nombres'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <?php if($apoderEditar): ?>
                            <input type="hidden" name="idApoderado" value="<?= $apoderEditar['idApoderado'] ?>">
                            <input type="hidden" name="accion" value="actualizar">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Nombres</label>
                            <input type="text" name="nombres" class="form-control" required
                                   value="<?= $apoderEditar ? $apoderEditar['nombres'] : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" class="form-control" required
                                   value="<?= $apoderEditar ? $apoderEditar['apellidos'] : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required
                                   value="<?= $apoderEditar ? $apoderEditar['telefono'] : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Parentesco</label>
                            <select name="parentesco" class="form-select" required>
                                <option value="">Seleccione parentesco</option>
                                <?php
                                    $par = $apoderEditar ? $apoderEditar['parentesco'] : '';
                                    $opcionesParentesco = [
                                        "MADRE" => "MADRE",
                                        "PADRE" => "PADRE",
                                        "ABUELO" => "ABUELO",
                                        "ABUELA" => "ABUELA",
                                        "OTRO" => "OTRO"
                                    ];
                                    foreach($opcionesParentesco as $val => $label){
                                        $selected = ($par == $val) ? 'selected' : '';
                                        echo "<option value=\"{$val}\" {$selected}>{$label}</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" required
                                   value="<?= $apoderEditar ? $apoderEditar['direccion'] : '' ?>">
                        </div>

                        <?php if($apoderEditar): ?>
                            <div class="d-grid gap-2">
                                <button class="btn btn-warning" type="submit">
                                    <i class="fa-solid fa-pen"></i> Actualizar
                                </button>
                                <a href="index.php?ruta=apoderado" class="btn btn-secondary">
                                    <i class="fa-solid fa-xmark"></i> Cancelar
                                </a>
                            </div>
                        <?php else: ?>
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="fa-solid fa-floppy-disk"></i> Guardar
                            </button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- DERECHA: BUSCADOR + TABLA -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-dark text-white p-3 rounded-top-4">
                    <h4 class="mb-0">
                        <i class="fa-solid fa-table"></i>
                        Lista de Apoderados
                    </h4>
                </div>

                <div class="card-body p-4">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input
                                type="text"
                                id="buscarApoderados"
                                class="form-control"
                                placeholder="Buscar apoderado por estudiante, nombres, apellidos, parentesco..."
                            >
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablaApoderados">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Estudiante</th>
                                    <th>Apoderado</th>
                                    <th>Teléfono</th>
                                    <th>Parentesco</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($apoderados as $a): ?>
                                    <tr>
                                        <td><?= $a["idApoderado"] ?></td>
                                        <td><?= $a["estudiante"] ?></td>
                                        <td><?= $a["nombres"] . ' ' . $a["apellidos"] ?></td>
                                        <td><?= $a["telefono"] ?></td>
                                        <td><?= $a["parentesco"] ?></td>
                                        <td>
                                            <a href="index.php?ruta=apoderado&idEditar=<?= $a['idApoderado'] ?>" class="btn btn-warning btn-sm">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a href="index.php?ruta=apoderado&eliminar=<?= $a['idApoderado'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar apoderado?')">
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
document.getElementById('buscarApoderados')?.addEventListener('input', function(){
    const q = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll('#tablaApoderados tbody tr');
    rows.forEach(r=>{
        const text = r.innerText.toLowerCase();
        r.style.display = text.includes(q) ? '' : 'none';
    });
});
</script>

</body>
</html>

