<?php
// Tabla de ejemplo (dashboard). 
// No depende de modelos para no romper si aún no existe consulta.
?>

<div class="row g-4 mt-1">

    <!-- Sección extra: resumen / alertas -->


    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-left: 6px solid #2563eb;">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h5 class="m-0 text-secondary"><i class="fa-solid fa-bell me-2 text-primary"></i> Resumen rápido</h5>
                        <p class="text-muted mb-0">Aquí puedes mostrar alertas y metas del día.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="badge rounded-pill text-bg-primary p-2 px-3">Meta: 50 matrículas</span>
                        <span class="badge rounded-pill text-bg-warning p-2 px-3">Pendiente: 8 pagos</span>
                        <span class="badge rounded-pill text-bg-success p-2 px-3">Ciclos: activo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 text-secondary"><i class="fa-solid fa-table me-2 text-primary"></i> Actividad reciente</h5>
                    <span class="badge rounded-pill text-bg-light border">Actualizado hoy</span>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Acción</th>
                                <th>Usuario</th>
                                <th>Detalle</th>
                                <th style="width:140px;">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge text-bg-primary">Nuevo</span></td>
                                <td>Estudiante</td>
                                <td>Pre-inscripción registrada</td>
                                <td>Hoy 09:15</td>
                            </tr>
                            <tr>
                                <td><span class="badge text-bg-warning">Pago</span></td>
                                <td>Apoderado</td>
                                <td>Comprobante validado</td>
                                <td>Hoy 10:02</td>
                            </tr>
                            <tr>
                                <td><span class="badge text-bg-success">Asistencia</span></td>
                                <td>Docente</td>
                                <td>Confirmada clase de ciclo</td>
                                <td>Ayer 17:40</td>
                            </tr>
                            <tr>
                                <td><span class="badge text-bg-info">Nota</span></td>
                                <td>Docente</td>
                                <td>Ingreso de evaluación</td>
                                <td>Ayer 16:10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">

            <div class="card-header bg-white">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="m-0 text-secondary"><i class="fa-solid fa-clock me-2 text-primary"></i> Próximos eventos</h5>
                    <a href="#" class="small text-decoration-none text-primary">Ver todo</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Día</th>
                                <th>Hora</th>
                                <th>Actividad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge text-bg-primary rounded-pill">Mar</span></td>
                                <td>07:30 - 09:00</td>
                                <td>Clases de Matemática</td>
                            </tr>
                            <tr>
                                <td><span class="badge text-bg-success rounded-pill">Jue</span></td>
                                <td>10:00 - 11:30</td>
                                <td>Simulacro de admisión</td>
                            </tr>
                            <tr>
                                <td><span class="badge text-bg-warning rounded-pill">Sáb</span></td>
                                <td>08:00 - 09:30</td>
                                <td>Pago/regularización matrículas</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 text-muted small">
                    <i class="fa-solid fa-circle-info me-1 text-primary"></i>
                    Mantén tu asistencia al día para evitar atrasos.
                </div>
            </div>
        </div>
    </div>
</div>

