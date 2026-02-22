<div class="modal fade" id="modalEmpleado<?= $fila['id'] ?>" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header text-white" style="background:#050505;">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-pencil-square"></i> Editar Perfil
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="controllers/editar.php" method="POST" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= $fila['id'] ?>">

        <div class="modal-body row g-3">

          <div class="col-md-6">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="nombre_completo" class="form-control"
                   value="<?= $fila['nombre_completo'] ?>" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Documento</label>
            <input type="text" name="documento" class="form-control"
                   value="<?= $fila['documento'] ?>" pattern="[0-9]+" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Correo</label>
            <input type="email" name="email" class="form-control"
                   value="<?= $fila['email'] ?>" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                   value="<?= $fila['telefono'] ?>" pattern="[0-9]+">
          </div>

          <div class="col-12">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control"
                   value="<?= $fila['direccion'] ?>">
          </div>

          <div class="col-md-6">
            <label class="form-label">Rol</label>
            <select name="rol" class="form-select" required>
              <option <?= $fila['rol']=='Administrador'?'selected':'' ?>>Administrador</option>
              <option <?= $fila['rol']=='Usuario'?'selected':'' ?>>Usuario</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select" required>
              <option <?= $fila['estado']=='Activo'?'selected':'' ?>>Activo</option>
              <option <?= $fila['estado']=='Inactivo'?'selected':'' ?>>Inactivo</option>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Cancelar</button>
          <button class="btn btn-dark fw-bold">Actualizar</button>
        </div>
      </form>

    </div>
  </div>
</div>