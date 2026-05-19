<?php
require_once "config/Conexion.php";
require_once "model/Docente.php";
require_once "controller/DocenteController.php";

/* =========================
   GUARDAR DOCENTE
========================= */
if (isset($_POST["accion"]) && $_POST["accion"] == "guardar") {

    $foto = "";

    if (!empty($_FILES["foto"]["name"])) {

        $nombre = time() . "_" . $_FILES["foto"]["name"];
        $ruta = "assets/img/docentes/" . $nombre;

        move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

        $foto = $ruta;
    }

    $data = [
        "dni" => $_POST["dni"],
        "nombres" => $_POST["nombres"],
        "apellidos" => $_POST["apellidos"],
        "especialidad" => $_POST["especialidad"],
        "correo" => $_POST["correo"],
        "telefono" => $_POST["telefono"],
        "direccion" => $_POST["direccion"],
        "estado" => $_POST["estado"],
        "foto" => $foto
    ];

    DocenteController::registrarDocente($data);

    header("Location: index.php?ruta=docente");
    exit;
}

/* =========================
   ACTUALIZAR DOCENTE
========================= */
if (isset($_POST["accion"]) && $_POST["accion"] == "actualizar") {

    $foto = $_POST["foto_actual"];

    if (!empty($_FILES["foto"]["name"])) {

        $nombre = time() . "_" . $_FILES["foto"]["name"];
        $ruta = "assets/img/docentes/" . $nombre;

        move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);

        $foto = $ruta;
    }

    $data = [
        "idDocente" => $_POST["idDocente"],
        "dni" => $_POST["dni"],
        "nombres" => $_POST["nombres"],
        "apellidos" => $_POST["apellidos"],
        "especialidad" => $_POST["especialidad"],
        "correo" => $_POST["correo"],
        "telefono" => $_POST["telefono"],
        "direccion" => $_POST["direccion"],
        "estado" => $_POST["estado"],
        "foto" => $foto
    ];

    DocenteController::actualizarDocente($data);

    header("Location: index.php?ruta=docente");
    exit;
}

/* =========================
   ELIMINAR DOCENTE
========================= */
if (isset($_GET["eliminar"])) {
    DocenteController::eliminarDocente($_GET["eliminar"]);
    header("Location: index.php?ruta=docente");
    exit;
}

/* =========================
   LISTAR DOCENTES
========================= */
$docentes = DocenteController::listarDocentes();

/* =========================
   EDITAR DOCENTE
========================= */
$idEditar = $_GET["idEditar"] ?? null;
$docenteEditar = $idEditar ? DocenteController::obtenerDocente($idEditar) : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Docentes</title>
<link rel="icon" type="image/png" href="assets/img/logos/logo.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
body{
    background:#f4f7fc;
}
.card-header{
    font-weight:bold;
}
table img{
    object-fit:cover;
}
</style>

</head>

<body>

<div class="container-fluid p-4">

    <!-- HEADER -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="index.php?ruta=dashboard" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>

        <h2 class="fw-bold">👨‍🏫 Docentes</h2>
    </div>

    <div class="row g-4">

        <!-- FORM -->
        <div class="col-lg-4">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">
                    <?= $docenteEditar ? "Editar Docente" : "Registrar Docente" ?>
                </div>

                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data">

                        <?php if($docenteEditar): ?>
                            <input type="hidden" name="idDocente" value="<?= $docenteEditar['idDocente'] ?>">
                            <input type="hidden" name="accion" value="actualizar">
                            <input type="hidden" name="foto_actual" value="<?= $docenteEditar['foto'] ?>">
                        <?php else: ?>
                            <input type="hidden" name="accion" value="guardar">
                        <?php endif; ?>

                        <input type="text" name="dni" class="form-control mb-2" placeholder="DNI"
                        value="<?= $docenteEditar['dni'] ?? '' ?>">

                        <input type="text" name="nombres" class="form-control mb-2" placeholder="Nombres"
                        value="<?= $docenteEditar['nombres'] ?? '' ?>">

                        <!-- APPELLIDOS CORREGIDO -->
                        <input type="text" name="apellidos" class="form-control mb-2" placeholder="Apellidos"
                        value="<?= $docenteEditar['apellidos'] ?? '' ?>">

                        <input type="text" name="especialidad" class="form-control mb-2" placeholder="Especialidad"
                        value="<?= $docenteEditar['especialidad'] ?? '' ?>">

                        <input type="text" name="correo" class="form-control mb-2" placeholder="Correo"
                        value="<?= $docenteEditar['correo'] ?? '' ?>">

                        <input type="text" name="telefono" class="form-control mb-2" placeholder="Teléfono"
                        value="<?= $docenteEditar['telefono'] ?? '' ?>">

                        <input type="text" name="direccion" class="form-control mb-2" placeholder="Dirección"
                        value="<?= $docenteEditar['direccion'] ?? '' ?>">

                        <!-- FOTO -->
                        <input type="file" name="foto" class="form-control mb-2">

                        <select name="estado" class="form-control mb-3">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>

                        <?php if($docenteEditar): ?>
                            <button class="btn btn-warning w-100">Actualizar</button>
                            <a href="index.php?ruta=docente" class="btn btn-secondary w-100 mt-2">Cancelar</a>
                        <?php else: ?>
                            <button class="btn btn-primary w-100">Guardar</button>
                        <?php endif; ?>

                    </form>

                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-dark text-white">
                    Lista de Docentes
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover text-center align-middle">

                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Foto</th>
                                    <th>DNI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Especialidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php foreach($docentes as $d): ?>
                                <tr>
                                    <td><?= $d["idDocente"] ?></td>

                                    <td>
                                        <?php if(!empty($d["foto"])): ?>
                                            <img src="<?= $d["foto"] ?>" width="45" height="45" style="border-radius:50%">
                                        <?php else: ?>
                                            Sin foto
                                        <?php endif; ?>
                                    </td>

                                    <td><?= $d["dni"] ?></td>
                                    <td><?= $d["nombres"] ?></td>
                                    <td><?= $d["apellidos"] ?></td>
                                    <td><?= $d["especialidad"] ?></td>

                                    <td>
                                        <a href="index.php?ruta=docente&idEditar=<?= $d['idDocente'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <a href="index.php?ruta=docente&eliminar=<?= $d['idDocente'] ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Eliminar docente?')">
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

</body>
</html>