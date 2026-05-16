# TODO - Eliminar y editar estudiante

- [ ] Actualizar `model/EstudianteModel.php` agregando: `obtenerPorId($id)` y `actualizar($id, $datos)`.
- [ ] Actualizar `controller/EstudianteController.php` agregando: `obtenerEstudiante($id)` y `editarEstudiante()` (POST) para hacer UPDATE.
- [ ] Actualizar `views/estudiantes.php`:
  - [ ] Cambiar botón eliminar para que llame a `index.php?ruta=estudiantes&idEliminar=...`.
  - [ ] Cambiar botón editar para que llame a `index.php?ruta=estudiantes&idEditar=...`.
  - [ ] Mostrar formulario de edición cuando exista `$_GET['idEditar']` (prellenado) y distinguir submit con `btnActualizar`.
- [x] Verificar flujo: listar → editar → actualizar → eliminar.


