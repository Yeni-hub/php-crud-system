<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../index.php');
}

if (!validateCsrfToken($_POST['_csrf_token'] ?? '')) {
    setFlash('danger', 'Token de seguridad inválido.');
    redirect('../index.php');
}

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    setFlash('danger', 'ID de perfil inválido.');
    redirect('../index.php');
}

try {
    $sql = "DELETE FROM perfiles WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() === 0) {
        setFlash('warning', 'No se encontró el perfil para eliminar.');
    } else {
        setFlash('success', 'Perfil eliminado exitosamente.');
    }
} catch (PDOException $e) {
    setFlash('danger', 'Error al eliminar el perfil.');
}

redirect('../index.php');
