<?php

require_once "config/Conexion.php";
require_once "model/Usuario.php";
require_once "model/Rol.php";
require_once "controller/UsuarioController.php";

/* =========================
    GUARDAR
========================= */
if(isset($_POST["accion"]) && $_POST["accion"]=="guardar"){

    $data = [
        "usuario" => $_POST["usuario"],
        "clave" => $_POST["clave"],
        "estado" => $_POST["estado"],
        "idRol" => $_POST["idRol"]
    ];

    UsuarioController::registrarUsuario($data);

    header("Location:index.php?ruta=usuarios");
    exit;
}

/* =========================
    ACTUALIZAR
========================= */
if(isset($_POST["accion"]) && $_POST["accion"]=="actualizar"){

    $data = [
        "idUsuario" => $_POST["idUsuario"],
        "usuario" => $_POST["usuario"],
        "clave" => $_POST["clave"],
        "estado" => $_POST["estado"],
        "idRol" => $_POST["idRol"]
    ];

    UsuarioController::actualizarUsuario($data);

    header("Location:index.php?ruta=usuarios");
    exit;
}

/* =========================
    ELIMINAR
========================= */
if(isset($_GET["eliminar"])){

    UsuarioController::eliminarUsuario($_GET["eliminar"]);

    header("Location:index.php?ruta=usuarios");
    exit;
}

/* =========================
    CAMBIAR ESTADO (CLICK EN BOTÓN)
========================= */
if(isset($_GET["toggleEstado"]) && isset($_GET["estadoNuevo"])){
    $idUsuario = $_GET["toggleEstado"];
    $estadoNuevo = $_GET["estadoNuevo"];

    // Solo permitimos valores válidos
    if($estadoNuevo === 'activo' || $estadoNuevo === 'inactivo'){
        UsuarioController::actualizarEstados([$idUsuario => $estadoNuevo]);
    }

    header("Location:index.php?ruta=usuarios");
    exit;
}

/* =========================
    DATOS
========================= */
$usuarios = UsuarioController::listarUsuarios();
$roles = Rol::listar();

$idEditar = $_GET["idEditar"] ?? null;
$usuarioEditar = $idEditar ? UsuarioController::obtenerUsuario($idEditar) : null;

if($idEditar && !$usuarioEditar){
    $usuarioEditar = null;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link rel="icon" type="image/png" href="assets/img/logos/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .card { border-radius: 10px; border: none; }
        .table thead { background-color: #212529; color: white; }
        .form-control, .form-select { border-radius: 6px; margin-bottom: 10px; }
        .btn-status { width: 90px; }
    </style>
</head>

<body class="bg-light">

<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="m-0">👤 Gestión de Usuarios</h3>
        <a href="index.php?ruta=dashboard" class="btn btn-outline-secondary shadow-sm">
            <i class="fa-solid fa-right-from-bracket"></i> Salir al Dashboard
        </a>
    </div>

    <div class="card p-3 mb-4 shadow-sm"> 
        <div class="d-flex align-items-center justify-content-between flex-wrap"> 
            <h4 class="m-0 text-secondary">Panel de Control</h4> 
            <span class="badge bg-primary">CRUD SISTEMA</span> 
        </div> 
    </div> 

    <div class="row g-4">

        <div class="col-lg-4">
            <div class="card p-4 shadow-sm">
                <h5 class="mb-3 text-primary"><?= $usuarioEditar ? 'Editar Usuario' : 'Nuevo Registro' ?></h5>
                <form method="POST">
                    <input type="hidden" name="idUsuario" value="<?= $usuarioEditar['idUsuario'] ?? '' ?>">
                    <input type="hidden" name="accion" value="<?= $usuarioEditar ? 'actualizar' : 'guardar' ?>">

                    <label class="small fw-bold">Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" value="<?= $usuarioEditar['usuario'] ?? '' ?>" required>

                    <label class="small fw-bold">Contraseña</label>
                    <input type="password" name="clave" class="form-control" placeholder="Clave" <?= $usuarioEditar ? '' : 'required' ?> >

                    <label class="small fw-bold">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="activo" <?= (isset($usuarioEditar) && $usuarioEditar['estado']=='activo')?'selected':'' ?>>Activo</option>
                        <option value="inactivo" <?= (isset($usuarioEditar) && $usuarioEditar['estado']=='inactivo')?'selected':'' ?>>Inactivo</option>
                    </select>

                    <label class="small fw-bold">Rol</label>
                    <select name="idRol" class="form-select mb-3" required>
                        <option value="">Seleccione rol</option>
                        <?php foreach($roles as $r){ ?>
                            <option value="<?= $r['idRol'] ?>" <?= (isset($usuarioEditar) && $usuarioEditar['idRol']==$r['idRol'])?'selected':'' ?>>
                                <?= $r['nombre'] ?>
                            </option>
                        <?php } ?>
                    </select>

                    <button class="btn btn-primary w-100 shadow-sm">
                        <i class="fa-solid fa-floppy-disk"></i> <?= $usuarioEditar ? 'Actualizar Cambios' : 'Guardar Usuario' ?>
                    </button>
                    
                    <?php if($idEditar): ?>
                        <a href="index.php?ruta=usuarios" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">Cancelar edición</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card p-3 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-light">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($usuarios as $u){ ?>
                            <tr class="text-center">
                                <td class="fw-bold"><?= $u['idUsuario'] ?></td>
                                <td><?= $u['usuario'] ?></td>
                                <td><span class="badge bg-light text-dark border"><?= $u['rol'] ?></span></td>
                                <td>
                                    <?php $nuevoEstado = ($u['estado'] === 'activo') ? 'inactivo' : 'activo'; ?>
                                    <a href="index.php?ruta=usuarios&toggleEstado=<?= $u['idUsuario'] ?>&estadoNuevo=<?= $nuevoEstado ?>" 
                                       onclick="return confirm('¿Cambiar estado?');"
                                       class="btn btn-sm btn-status <?= ($u['estado']==='activo') ? 'btn-success' : 'btn-danger' ?>">
                                        <?= ($u['estado']==='activo') ? 'Activo' : 'Inactivo' ?>
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="index.php?ruta=usuarios&idEditar=<?= $u['idUsuario'] ?>" class="btn btn-warning btn-sm shadow-sm">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="index.php?ruta=usuarios&eliminar=<?= $u['idUsuario'] ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('¿Eliminar usuario?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> 
</div> 

</body>
</html>