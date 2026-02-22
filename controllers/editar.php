<?php
require_once "../config/conexion.php";

if ($_POST) {
    $sql = "UPDATE perfiles SET
        nombre_completo = ?,
        documento = ?,
        email = ?,
        telefono = ?,
        direccion = ?,
        rol = ?,
        estado = ?
        WHERE id = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        $_POST['nombre_completo'],
        $_POST['documento'],
        $_POST['email'],
        $_POST['telefono'],
        $_POST['direccion'],
        $_POST['rol'],
        $_POST['estado'],
        $_POST['id']
    ]);
}

header("Location: ../index.php");
exit;