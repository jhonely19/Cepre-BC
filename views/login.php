<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login CEPRE BC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<div class="container-fluid">

    <div class="row vh-100">

        <div class="col-lg-7 d-none d-lg-flex fondo">

            <div class="contenido">

                <h1>CEPRE BC</h1>

                <p>
                    Sistema Web Académico
                </p>

            </div>

        </div>

        <div class="col-lg-5 d-flex justify-content-center align-items-center">

            <form method="POST" class="login-box">

                <h2 class="mb-4 text-center">
                    Iniciar Sesión
                </h2>

                <input 
                    type="text"
                    name="usuario"
                    class="form-control mb-3"
                    placeholder="Usuario"
                    required
                >

                <input 
                    type="password"
                    name="clave"
                    class="form-control mb-3"
                    placeholder="Contraseña"
                    required
                >

                <button class="btn btn-primary w-100">
                    Ingresar
                </button>

                <?php

                    LoginController::ingresar();

                ?>

            </form>

        </div>

    </div>

</div>

</body>
</html>