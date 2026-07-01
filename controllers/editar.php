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

$id        = (int) ($_POST['id'] ?? 0);
$nombre    = trim($_POST['nombre_completo'] ?? '');
$documento = trim($_POST['documento'] ?? '');
$email     = trim($_POST['email'] ?? '');
$telefono  = trim($_POST['telefono'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$rol       = $_POST['rol'] ?? '';
$estado    = $_POST['estado'] ?? '';

if ($id <= 0) {
    setFlash('danger', 'ID de perfil inválido.');
    redirect('../index.php');
}

$error = validateRequiredFields(
    compact('nombre', 'documento', 'email', 'rol', 'estado'),
    ['nombre', 'documento', 'email', 'rol', 'estado']
);

if ($error) {
    setFlash('danger', $error);
    redirect('../index.php');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setFlash('danger', 'El formato del correo electrónico no es válido.');
    redirect('../index.php');
}

if (!ctype_digit($documento)) {
    setFlash('danger', 'El documento debe contener solo números.');
    redirect('../index.php');
}

if ($telefono !== '' && !ctype_digit($telefono)) {
    setFlash('danger', 'El teléfono debe contener solo números.');
    redirect('../index.php');
}

try {
    $sql = "UPDATE perfiles SET
                nombre_completo = :nombre,
                documento       = :documento,
                email           = :email,
                telefono        = :telefono,
                direccion       = :direccion,
                rol             = :rol,
                estado          = :estado
            WHERE id = :id";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':nombre'    => $nombre,
        ':documento' => $documento,
        ':email'     => $email,
        ':telefono'  => $telefono,
        ':direccion' => $direccion,
        ':rol'       => $rol,
        ':estado'    => $estado,
        ':id'        => $id,
    ]);

    setFlash('success', 'Perfil actualizado exitosamente.');
} catch (PDOException $e) {
    setFlash('danger', 'Error al actualizar el perfil.');
}

redirect('../index.php');
