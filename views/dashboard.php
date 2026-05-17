<?php

session_start();

if(!isset($_SESSION["login"])){

    header("Location:index.php?ruta=login");

    exit();

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard CEPRE BC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="assets/css/dashboard.css">

</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->

    <aside class="sidebar" id="sidebar">

        <div class="logo">

            <img src="imagenes/logo.png">

            <h2>CEPRE BC</h2>

        </div>

        <ul>

            <li>
                <a href="#">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-users"></i>
                    Usuarios
                </a>
            </li>

            <li>
                <a href="index.php?ruta=estudiantes">
                    <i class="fa-solid fa-user-graduate"></i>
                    Estudiantes
                </a>
            </li>

            <li>
                <a href="index.php?ruta=apoderado" class="btn btn-primary">

                    <i class="fa-solid fa-people-roof"></i>
                    Apoderados
                </a>
            </li>

            <li>
                <a href="index.php?ruta=docente" class="btn btn-primary">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    Docentes
                </a>
            </li>

            <li>
                <a href="index.php?ruta=ciclo" class="btn btn-primary">
                    <i class="fa-solid fa-layer-group"></i>
                    Ciclos
                </a>
            </li>

            <li>
                <a href="index.php?ruta=curso" class="btn btn-primary">
                    <i class="fa-solid fa-book"></i>
                    Cursos
                </a>
            </li>

            <li>
                <a href="index.php?ruta=aula" class="btn btn-primary">
                    <i class="fa-solid fa-school"></i>
                    Aulas
                </a>
            </li>

            <li>
                <a href="index.php?ruta=horario" class="btn btn-primary">
                    <i class="fa-solid fa-clock"></i>
                    Horarios
                </a>
            </li>

            <li>
                <a href="index.php?ruta=matricula" class="btn btn-primary">
                    <i class="fa-solid fa-file-signature"></i>
                    Matrículas
                </a>
            </li>

            <li>
                <a href="index.php?ruta=evaluacion" class="btn btn-primary">
                    <i class="fa-solid fa-clipboard-check"></i>
                    Evaluaciones
                </a>
            </li>

            <li>
                <a href="index.php?ruta=nota" class="btn btn-primary">
                    <i class="fa-solid fa-chart-line"></i>
                    Notas
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-calendar-check"></i>
                    Asistencias
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    Pagos
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-receipt"></i>
                    Comprobantes
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-bullhorn"></i>
                    Anuncios
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-newspaper"></i>
                    Noticias
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-calendar-days"></i>
                    Eventos
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-envelope"></i>
                    Contactos
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-globe"></i>
                    Inscripciones Web
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-images"></i>
                    Galería
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-image"></i>
                    Sliders
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    Configuración
                </a>
            </li>
            

        </ul>

    </aside>

    <!-- MAIN -->

    <main class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            <button class="menu-btn" id="menu-btn">

                <i class="fa-solid fa-bars"></i>

            </button>

            <div class="usuario-box">

                <span>

                    Bienvenido,
                    <strong>
                        <?php echo $_SESSION["usuario"]; ?>
                    </strong>

                </span>

                <a href="logout.php" class="btn btn-danger">

                    <i class="fa-solid fa-right-from-bracket"></i>
                    Cerrar sesión

                </a>

            </div>

        </div>

        <!-- CONTENIDO -->

        <div class="container-fluid mt-4">

            <div class="row g-4">

                <div class="col-lg-3 col-md-6">

                    <div class="card-dashboard azul">

                        <div>

                            <h5>Estudiantes</h5>

                            <h2>350</h2>

                        </div>

                        <i class="fa-solid fa-user-graduate"></i>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="card-dashboard verde">

                        <div>

                            <h5>Docentes</h5>

                            <h2>25</h2>

                        </div>

                        <i class="fa-solid fa-chalkboard-user"></i>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="card-dashboard amarillo">

                        <div>

                            <h5>Cursos</h5>

                            <h2>18</h2>

                        </div>

                        <i class="fa-solid fa-book"></i>

                    </div>

                </div>

                <div class="col-lg-3 col-md-6">

                    <div class="card-dashboard rojo">

                        <div>

                            <h5>Pagos</h5>

                            <h2>S/ 12000</h2>

                        </div>

                        <i class="fa-solid fa-money-bill-wave"></i>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>


<script src="assets/js/app.js"></script>

</body>
</html>