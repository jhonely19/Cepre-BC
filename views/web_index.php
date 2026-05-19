<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEPRE BC | Centro de Preparación Preuniversitaria</title>
    <link rel="icon" type="image/png" href="assets/img/logos/logo.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome (Iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="assets/css/styles_web.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container nav-container">
            <!-- Contenedor del Logo e Identidad Visual a la Izquierda -->
            <a class="logo" href="#inicio">
                <img src="assets/img/logos/logo.png" alt="Logo" class="nav-logo" style="display:block; height:52px; width:auto;" />
                <span class="logo-text">CEPRE<span>BC</span></span>
            </a>
            
            <!-- Checkbox para menú móvil sin depender de JS complejo de inmediato -->
            <input type="checkbox" id="menu-toggle" class="menu-toggle">
            <label for="menu-toggle" class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </label>
            
            <!-- Enlaces de navegación -->
            <ul class="nav-links">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#nosotros">Nosotros</a></li>
                <li><a href="#cursos">Áreas</a></li>
                <li><a href="#inscripcion" class="btn-nav-inscripcion">Pre-Inscripción</a></li>
                <li><a href="index.php?ruta=login" class="btn-login">Iniciar sesión</a></li>
            </ul>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header id="inicio" class="hero">
        <div class="hero-overlay"></div>
            <div class="hero-content container">
                <div class="hero-cta">
                    <div>
                        <span class="badge">¡Inscripciones Abiertas 2026!</span>
                        <h1>Asegura tu Ingreso con <br><span>CEPRE BC</span></h1>
                        <p>La mejor preparación académica con los docentes más experimentados de la región. Tu futuro profesional comienza aquí.</p>
                        <div class="hero-btns">
                            <a href="#inscripcion" class="btn-primary">Pre-Inscríbete ahora <i class="fas fa-arrow-right"></i></a>
                            <a href="#cursos" class="btn-outline">Ver Ciclos Académicos</a>
                        </div>
                    </div>




                </div>

            </div>
        </div>
    </header>

    <!-- ESTADÍSTICAS -->
    <section class="stats-wrapper">
        <div class="stats container">
            <div class="stat-item">
                <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="stat-info">
                    <h3>+500</h3>
                    <p>Ingresantes</p>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fas fa-award"></i></div>
                <div class="stat-info">
                    <h3>15 Años</h3>
                    <p>De Experiencia</p>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="stat-info">
                    <h3>20</h3>
                    <p>Docentes Especialistas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN NOSOTROS -->
    <section id="nosotros" class="section container">
        <div class="nosotros-grid">
            <div class="nosotros-img">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=600" alt="Estudiantes CEPRE BC">
            </div>
            <div class="nosotros-text">
                <h2 class="section-title text-left">¿Por qué elegir <span>CEPRE BC</span>?</h2>
                <p>Somos el centro preuniversitario líder en la región de Ucayali. Nuestra metodología combina una exigencia académica de alto nivel con un soporte emocional y de orientación vocacional constante.</p>
                <ul class="beneficios-list">
                    <li><i class="fas fa-check-circle"></i> <span><strong>Simulacros tipo examen:</strong> Evaluaciones semanales con el rigor real de admisión.</span></li>
                    <li><i class="fas fa-check-circle"></i> <span><strong>Material exclusivo:</strong> Textos y bancos de preguntas actualizados constantemente.</span></li>
                    <li><i class="fas fa-check-circle"></i> <span><strong>Infraestructura ideal:</strong> Biblioteca y áreas diseñadas para tu concentración.</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- SECCIÓN ÁREAS DE ESTUDIO -->
    <section id="cursos" class="section bg-light">
        <div class="container">
            <h2 class="section-title">Nuestras Áreas de Estudio</h2>
            <p class="section-subtitle">Especialízate según la carrera de tu elección con enfoques totalmente dirigidos.</p>
            <div class="grid-cursos">
                <div class="curso-card">
                    <div class="curso-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&q=80&w=400" alt="Ciencias e Ingenierías">
                    </div>
                    <div class="curso-card-body">
                        <div class="card-icon-box"><i class="fas fa-flask"></i></div>
                        <h3>Ciencias e Ingenierías</h3>
                        <p>Preparación intensiva en matemáticas avanzadas, física, química y razonamiento matemático fluido.</p>
                    </div>
                </div>
                <div class="curso-card">
                    <div class="curso-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=400" alt="Letras y Derecho">
                    </div>
                    <div class="curso-card-body">
                        <div class="card-icon-box"><i class="fas fa-gavel"></i></div>
                        <h3>Letras y Derecho</h3>
                        <p>Enfoque estratégico en comprensión lectora profunda, historia universal y del Perú, geografía y cívica.</p>
                    </div>
                </div>
                <div class="curso-card">
                    <div class="curso-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&q=80&w=400" alt="Ciencias de la Salud">
                    </div>
                    <div class="curso-card-body">
                        <div class="card-icon-box"><i class="fas fa-heartbeat"></i></div>
                        <h3>Ciencias de la Salud</h3>
                        <p>Alto nivel académico en biología celular, anatomía humana detallada, genética y química orgánica.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FORMULARIO DE INSCRIPCIÓN -->
    <section id="inscripcion" class="section bg-form-gradient">
        <div class="container registration-box">
            <div class="info-text">
                <h2>¿Listo para asegurar tu vacante?</h2>
                <p>Déjanos tus datos de contacto y un asesor académico se comunicará contigo de inmediato vía WhatsApp para explicarte las promociones, horarios y facilidades de pago.</p>
                <div class="info-contact-quick">
                    <a href="https://wa.me/51999888777" target="_blank" class="whatsapp-badge">
                        <i class="fab fa-whatsapp"></i>
                        <div>
                            <span>Atención inmediata:</span>
                            <strong>+51 999 888 777</strong>
                        </div>
                    </a>
                </div>
            </div>
            <div class="form-wrapper">
                <form action="index.php?ruta=procesar_web" method="POST" class="web-form">
                    <h3>Formulario de Pre-Inscripción</h3>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="nombres" placeholder="Tus nombres" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-user-tag input-icon"></i>
                        <input type="text" name="apellidos" placeholder="Tus apellidos" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-id-card input-icon"></i>
                        <input type="text" name="dni" placeholder="Número de DNI" required maxlength="8" pattern="[0-9]{8}">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="tel" name="telefono" placeholder="WhatsApp de contacto" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-graduation-cap input-icon"></i>
                        <select name="carrera" required>
                            <option value="">Selecciona tu área de interés</option>
                            <option value="Ingenieria">Ingeniería y Ciencias Exactas</option>
                            <option value="Salud">Ciencias de la Salud / Medicina</option>
                            <option value="Derecho">Derecho y Ciencias Sociales</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-submit">Enviar Datos y Reservar Cupo <i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container footer-grid">
            <div class="footer-logo">
                <h2>CEPRE<span>BC</span></h2>
                <p>15 años liderando los primeros puestos en los exámenes de admisión de la región. Excelencia comprobada para tu ingreso universitario.</p>
            </div>
            <div class="footer-contact">
                <h4>Contáctanos</h4>
                <p><i class="fas fa-map-marker-alt text-primary"></i> Jr. 7 de Junio - Yarinacocha, Pucallpa</p>
                <p><i class="fas fa-phone text-primary"></i> +51 999 888 777</p>
                <p><i class="fas fa-envelope text-primary"></i> informes@ceprebc.edu.pe</p>
            </div>
            <div class="footer-social">
                <h4>Síguenos en Redes</h4>
                <div class="social-links">
                    <a href="https://facebook.com" target="_blank" class="facebook" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank" class="instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/51999888777" target="_blank" class="whatsapp" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 CEPRE BC. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>