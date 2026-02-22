<?php
require_once "config/conexion.php";
include "views/header.php";
?>

<div class="card shadow">

  <div class="card-header d-flex justify-content-between align-items-center text-white" style="background:#050505;">
    <h5 class="mb-0">Perfiles</h5>
    <button class="btn btn-light fw-bold text-dark"
            data-bs-toggle="modal"
            data-bs-target="#modalEmpleadoNuevo">
      <i class="bi bi-plus-circle"></i> NUEVO
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="text-white" style="background:#050505;">
          <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Estado</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $sql = "SELECT * FROM perfiles ORDER BY id DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($datos):
          foreach ($datos as $fila):
        ?>
          <tr>
            <td><?= htmlspecialchars($fila['nombre_completo']) ?></td>
            <td><?= htmlspecialchars($fila['email']) ?></td>
            <td><?= htmlspecialchars($fila['telefono']) ?></td>
            <td><?= htmlspecialchars($fila['rol']) ?></td>
            <td>
              <span class="badge <?= $fila['estado']=='Activo'?'bg-success':'bg-secondary' ?>">
                <?= $fila['estado'] ?>
              </span>
            </td>
            <td class="text-center">

              <!-- EDITAR -->
              <button class="btn btn-sm btn-warning fw-bold text-dark"
                      data-bs-toggle="modal"
                      data-bs-target="#modalEmpleado<?= $fila['id'] ?>">
                <i class="bi bi-pencil-square"></i>
              </button>

              <!-- ELIMINAR -->
              <a href="controllers/eliminar.php?id=<?= $fila['id'] ?>"
                 class="btn btn-sm btn-danger fw-bold"
                 onclick="return confirm('¿Seguro que deseas eliminar este perfil?')">
                <i class="bi bi-trash"></i>
              </a>

            </td>
          </tr>

          <!-- MODAL EDITAR -->
          <?php include "views/modal_empleado.php"; ?>

        <?php endforeach; else: ?>
          <tr>
            <td colspan="6" class="text-center text-muted">No hay registros</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- MODAL NUEVO -->
<?php include "views/modal_Nuevo.php"; ?>
<?php include "views/footer.php"; ?>