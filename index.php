<?php
require_once "config/database.php";
require_once "includes/functions.php";

$page    = max(1, (int) ($_GET['page'] ?? 1));
$search  = trim($_GET['search'] ?? '');
$limit   = 10;
$offset  = ($page - 1) * $limit;

$where  = '';
$params = [];

if ($search !== '') {
    $where = "WHERE nombre_completo LIKE :search OR email LIKE :search OR documento LIKE :search";
    $params[':search'] = "%$search%";
}

$totalStmt = $conexion->prepare("SELECT COUNT(*) FROM perfiles $where");
$totalStmt->execute($params);
$total   = (int) $totalStmt->fetchColumn();
$pages   = max(1, (int) ceil($total / $limit));

if ($page > $pages) $page = $pages;

$sql = "SELECT id, nombre_completo, email, telefono, rol, estado
        FROM perfiles $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
$stmt = $conexion->prepare($sql);
$stmt->execute($params);
$datos = $stmt->fetchAll();

include "views/header.php";
$flashes = getFlashes();
?>

<?php foreach ($flashes as $flash): ?>
<div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
    <?= h($flash['message']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endforeach; ?>

<div class="card shadow">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 text-white" style="background:#050505;">
        <h5 class="mb-0"><i class="bi bi-people-fill"></i> Perfiles</h5>
        <div class="d-flex gap-2">
            <form method="GET" class="d-flex gap-2" role="search">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Buscar..." value="<?= h($search) ?>">
                <button class="btn btn-sm btn-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
                <?php if ($search !== ''): ?>
                    <a href="index.php" class="btn btn-sm btn-outline-light">Limpiar</a>
                <?php endif; ?>
            </form>
            <button class="btn btn-light fw-bold text-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalEmpleadoNuevo">
                <i class="bi bi-plus-circle"></i> NUEVO
            </button>
        </div>
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
                <?php if ($datos): ?>
                    <?php foreach ($datos as $fila): ?>
                    <tr>
                        <td><?= h($fila['nombre_completo']) ?></td>
                        <td><?= h($fila['email']) ?></td>
                        <td><?= h($fila['telefono']) ?></td>
                        <td><?= h($fila['rol']) ?></td>
                        <td>
                            <span class="badge <?= $fila['estado'] === 'Activo' ? 'bg-success' : 'bg-secondary' ?>">
                                <?= h($fila['estado']) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalEmpleado<?= $fila['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form method="POST" action="controllers/eliminar.php" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este perfil?')">
                                <?= csrfField() ?>
                                <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                <button class="btn btn-sm btn-danger fw-bold" type="submit">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php include "views/modal_Empleado.php"; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <?= $search !== '' ? 'No se encontraron resultados para "' . h($search) . '"' : 'No hay registros' ?>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($pages > 1): ?>
        <nav>
            <ul class="pagination pagination-sm justify-content-center mb-0">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Siguiente</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>

<?php include "views/modal_Nuevo.php"; ?>
<?php include "views/footer.php"; ?>
