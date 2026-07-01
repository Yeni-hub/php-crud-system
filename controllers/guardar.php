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

$nombre    = trim($_POST['nombre_completo'] ?? '');
$documento = trim($_POST['documento'] ?? '');
$email     = trim($_POST['email'] ?? '');
$telefono  = trim($_POST['telefono'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$rol       = $_POST['rol'] ?? '';
$estado    = $_POST['estado'] ?? '';

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
    $sql = "INSERT INTO perfiles (nombre_completo, documento, email, telefono, direccion, rol, estado)
            VALUES (:nombre, :documento, :email, :telefono, :direccion, :rol, :estado)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':nombre'    => $nombre,
        ':documento' => $documento,
        ':email'     => $email,
        ':telefono'  => $telefono,
        ':direccion' => $direccion,
        ':rol'       => $rol,
        ':estado'    => $estado,
    ]);

    setFlash('success', 'Perfil creado exitosamente.');
} catch (PDOException $e) {
    setFlash('danger', 'Error al crear el perfil. Verifica que el correo o documento no estén duplicados.');
}

redirect('../index.php');
