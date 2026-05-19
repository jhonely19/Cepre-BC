<?php

$estudiantes = EstudianteController::listarEstudiantes();

$idEditar = isset($_GET["idEditar"]) ? $_GET["idEditar"] : null;
$estEditar = $idEditar ? EstudianteController::obtenerEstudiante($idEditar) : null;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estudiantes</title>
    <link rel="icon" type="image/png" href="assets/img/logos/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilos_estudiantes.css">

</head>

<body style="background:#f4f7fc;">

<div class="container-fluid p-4">

    <!-- TITULO -->

    <div class="mb-4 d-flex align-items-center justify-content-between">

        <a href="index.php?ruta=dashboard" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Volver
        </a>

        <div class="mb-4"></div>

        <h2 class="fw-bold">
            Gestión de Estudiantes
        </h2>

        <p class="text-secondary">
            Administra los estudiantes de la CEPRE
        </p>

    </div>

    <!-- FORMULARIO -->

    <div class="card border-0 shadow-lg rounded-4 mb-5">

        <div class="card-header bg-primary text-white p-3 rounded-top-4">

            <h4 class="mb-0">

                <?php if($estEditar): ?>
                    <i class="fa-solid fa-pen"></i>
                    Editar Estudiante
                <?php else: ?>
                    <i class="fa-solid fa-user-plus"></i>
                    Agregar Estudiante
                <?php endif; ?>

            </h4>

        </div>

        <div class="card-body p-4">

            <form method="POST" enctype="multipart/form-data">

            <?php

            $registrar = new EstudianteController();

            // IMPORTANTE: solo llamar eliminar cuando venga por GET (click en la tabla)
            if(isset($_GET["idEliminar"])){
                $registrar->eliminarEstudiante();
            }

            // Evitar que al actualizar dispare también el INSERT
            if(isset($_POST["btnActualizar"])){
                $registrar->editarEstudiante();
            }else{
                $registrar->registrarEstudiante();
            }

            ?>

            <?php if($estEditar): ?>
                <input type="hidden" name="idEstudiante" value="<?php echo $estEditar["idEstudiante"]; ?>">
            <?php endif; ?>

            <?php
                $v = function($key, $default = "") use ($estEditar){
                    if(!$estEditar) return $default;
                    return isset($estEditar[$key]) ? $estEditar[$key] : $default;
                };
            ?>

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label>DNI</label>

                    <input
                        type="text"
                        name="dni"
                        class="form-control"
                        required
                        inputmode="numeric"
                        pattern="[0-9]+"
                        oninput="this.value=this.value.replace(/\D/g,'');"
                        value="<?php echo $v("dni"); ?>"
                    >

                </div>

                <div class="col-md-3 mb-3">

                    <label>Nombres</label>

                    <input
                        type="text"
                        name="nombres"
                        class="form-control"
                        required
                        value="<?php echo $v("nombres"); ?>"
                    >

                </div>

                <div class="col-md-3 mb-3">

                    <label>Apellidos</label>

                    <input
                        type="text"
                        name="apellidos"
                        class="form-control"
                        required
                        value="<?php echo $v("apellidos"); ?>"
                    >

                </div>

                <div class="col-md-3 mb-3">

                    <label>Sexo</label>

                    <select
                        name="sexo"
                        class="form-select"
                    >

                        <option value="Masculino" <?php echo ($v("sexo")=="Masculino")?"selected":""; ?>>Masculino</option>

                        <option value="Femenino" <?php echo ($v("sexo")=="Femenino")?"selected":""; ?>>Femenino</option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Fecha Nacimiento</label>

                    <input
                        type="date"
                        name="fechaNacimiento"
                        class="form-control"
                        value="<?php echo $v("fechaNacimiento"); ?>"
                    >

                </div>

                <div class="col-md-3 mb-3">

                    <label>Correo</label>

                    <input
                        type="email"
                        name="correo"
                        class="form-control"
                        value="<?php echo $v("correo"); ?>"
                    >

                </div>

                <div class="col-md-3 mb-3">

                    <label>Teléfono</label>

                    <input
                        type="text"
                        name="telefono"
                        class="form-control"
                        inputmode="numeric"
                        pattern="[0-9]+"
                        oninput="this.value=this.value.replace(/\D/g,'');"
                        value="<?php echo $v("telefono"); ?>"
                    >

                </div>

                <div class="col-md-3 mb-3">

                    <label>Carrera</label>

                    <input
                        type="text"
                        name="carrera"
                        class="form-control"
                        value="<?php echo $v("carrera"); ?>"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label>Dirección</label>

                    <input
                        type="text"
                        name="direccion"
                        class="form-control"
                        value="<?php echo $v("direccion"); ?>"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label>Colegio Procedencia</label>

                    <input
                        type="text"
                        name="colegioProcedencia"
                        class="form-control"
                        value="<?php echo $v("colegioProcedencia"); ?>"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label>Foto</label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                    >

                </div>

                <div class="col-md-6 mb-3">

                    <label>Estado</label>

                    <select
                        name="estado"
                        class="form-select"
                    >

                        <option value="activo" <?php echo ($v("estado")=="activo")?"selected":""; ?>>Activo</option>

                        <option value="retirado" <?php echo ($v("estado")=="retirado")?"selected":""; ?>>Retirado</option>

                    </select>

                </div>

            </div>

            <?php if($estEditar): ?>
                <button class="btn btn-primary px-4" name="btnActualizar">

                    <i class="fa-solid fa-pen"></i>

                    Actualizar Estudiante

                </button>
            <?php else: ?>
                <button class="btn btn-primary px-4">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Guardar Estudiante

                </button>
            <?php endif; ?>

            </form>

        </div>

    </div>

    <!-- TABLA -->

    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-header bg-dark text-white p-3 rounded-top-4">

            <h4 class="mb-0">

                <i class="fa-solid fa-table"></i>
                Lista de Estudiantes

            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-primary">

                        <tr>

                            <th>ID</th>
                            <th>Foto</th>
                            <th>Estudiante</th>
                            <th>DNI</th>
                            <th>Sexo</th>
                            <th>Nacimiento</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Colegio</th>
                            <th>Carrera</th>
                            <th>Estado</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach($estudiantes as $est): ?>

                        <tr>

                            <td>

                                <?php echo $est["idEstudiante"]; ?>

                            </td>

                            <td>

                            <img
    src="assets/img/estudiantes/<?php echo $est["foto"]; ?>"
    width="50"
   height="50"
    style="border-radius:50%; object-fit:cover;"
>

                            </td>

                            <td>

                                <div>

                                    <strong>

                                        <?php echo $est["nombres"]; ?>
                                        <?php echo $est["apellidos"]; ?>

                                    </strong>

                                </div>

                            </td>

                            <td>

                                <?php echo $est["dni"]; ?>

                            </td>

                            <td>

                                <?php echo $est["sexo"]; ?>

                            </td>

                            <td>

                                <?php echo $est["fechaNacimiento"]; ?>

                            </td>

                            <td>

                                <?php echo $est["correo"]; ?>

                            </td>

                            <td>

                                <?php echo $est["telefono"]; ?>

                            </td>

                            <td>

                                <?php echo $est["direccion"]; ?>

                            </td>

                            <td>

                                <?php echo $est["colegioProcedencia"]; ?>

                            </td>

                            <td>

                                <?php echo $est["carrera"]; ?>

                            </td>

                            <td>

                                <?php echo $est["estado"]; ?>

                            </td>

                            <td>

                                <a class="btn btn-warning btn-sm" href="index.php?ruta=estudiantes&idEditar=<?php echo $est["idEstudiante"]; ?>">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <a class="btn btn-danger btn-sm" href="index.php?ruta=estudiantes&idEliminar=<?php echo $est["idEstudiante"]; ?>" onclick="return confirm('¿Eliminar estudiante?');">

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

</body>
</html>