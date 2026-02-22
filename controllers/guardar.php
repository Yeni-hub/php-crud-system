<?php
require_once "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST['nombre_completo'] ?? '');
    $documento = trim($_POST['documento'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $rol = trim($_POST['rol'] ?? '');
    $estado = trim($_POST['estado'] ?? '');

    // Validación básica en servidor
    if (
        empty($nombre) ||
        empty($documento) ||
        empty($email) ||
        empty($rol) ||
        empty($estado)
    ) {
        header("Location: ../index.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php");
        exit;
    }

    if (!ctype_digit($documento)) {
        header("Location: ../index.php");
        exit;
    }

    if (!empty($telefono) && !ctype_digit($telefono)) {
        header("Location: ../index.php");
        exit;
    }

    try {
        $sql = "INSERT INTO perfiles 
        (nombre_completo, documento, email, telefono, direccion, rol, estado) 
        VALUES (:nombre, :documento, :email, :telefono, :direccion, :rol, :estado)";

        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":documento", $documento);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":direccion", $direccion);
        $stmt->bindParam(":rol", $rol);
        $stmt->bindParam(":estado", $estado);

        $stmt->execute();

        header("Location: ../index.php");
        exit;

    } catch (PDOException $e) {
        echo "Error al guardar: " . $e->getMessage();
    }
} else {
    header("Location: ../index.php");
    exit;
}