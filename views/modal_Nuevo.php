<div class="modal fade" id="modalEmpleadoNuevo" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-white" style="background:#050505;">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-plus-circle"></i> Nuevo Perfil
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="controllers/guardar.php" method="POST" class="needs-validation" novalidate>
        <?= csrfField() ?>

        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label class="form-label">Nombre completo <span class="text-danger">*</span></label>
            <input type="text" name="nombre_completo" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Documento <span class="text-danger">*</span></label>
            <input type="text" name="documento" class="form-control" pattern="[0-9]+" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Correo <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" pattern="[0-9]+">
          </div>
          <div class="col-12">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Rol <span class="text-danger">*</span></label>
            <select name="rol" class="form-select" required>
              <option value="">Seleccione...</option>
              <option>Administrador</option>
              <option>Usuario</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Estado <span class="text-danger">*</span></label>
            <select name="estado" class="form-select" required>
              <option value="">Seleccione...</option>
              <option>Activo</option>
              <option>Inactivo</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-dark fw-bold">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
