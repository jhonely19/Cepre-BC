<?php /* login.php */
    // Importante: evitar cualquier salida antes de redirects (headers)
    ob_start();
?>
<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | CEPRE BC</title>
    <link rel="icon" type="image/png" href="assets/img/logos/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/login_custom.css">
</head>
<body>

<div class="container-fluid">
    <div class="row vh-100 m-0">
        <div class="col-12 d-flex justify-content-center align-items-center p-3">
            <div class="login-box animate-fade-in">
                
                <!-- Sección del Logo y Bienvenida -->
                <div class="text-center mb-4">
                    <!-- Reemplaza 'assets/img/logos/logo.png' por la ruta real de tu logo -->
                    <img src="assets/img/logos/logo.png" alt="Logo CEPRE BC" class="login-logo">
                    <h2>¡Bienvenido!</h2>
                    <p class="text-muted text-subtitle">Ingresa tus credenciales para continuar</p>
                </div>

                <!-- Formulario de Login -->
                <form method="POST" autocomplete="off">
                    
                    <!-- Campo Usuario -->
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <div class="input-group standard-input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input 
                                type="text"
                                name="usuario"
                                class="form-control"
                                placeholder="Nombre de usuario"
                                required
                            >
                        </div>
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <div class="input-group standard-input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input 
                                type="password"
                                name="clave"
                                class="form-control"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                    </div>

                    <!-- Meta: Recordarme y Regresar al Inicio alternativo -->
                    <div class="login-meta mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check m-0">
                            <input class="form-check-input" type="checkbox" value="" id="recuerdame" />
                            <label class="form-check-label" for="recuerdame">Recordarme</label>
                        </div>
                        <a class="login-link-meta" href="index.php">
                            <i class="fas fa-arrow-left me-1"></i> Regresar al inicio
                        </a>
                    </div>

                    <!-- Botón Principal: Iniciar Sesión -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-login py-2.5">
                            Iniciar Sesión <i class="fas fa-sign-in-alt ms-2"></i>
                        </button>
                    </div>

                    <!-- Botón Cancelar / Salir -->
                    <div class="text-center">
                        <button type="button" class="btn btn-cancel-custom w-100" onclick="window.location.href='index.php'">
                            Cancelar <i class="fas fa-times ms-1"></i>
                        </button>
                    </div>

                    <?php
                        // Conserva tu controlador original de PHP
                        LoginController::ingresar();
                    ?>
                </form>
                
                <!-- Footer del Formulario -->
                <div class="text-center mt-4 pt-2 border-top-light">
                    <small class="text-muted-custom">&copy; 2026 CEPRE BC. Todos los derechos reservados.</small>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>