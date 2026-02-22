<?php
require_once "../config/conexion.php";

if (isset($_GET['id'])) {
    $sql = "DELETE FROM perfiles WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$_GET['id']]);
}

header("Location: ../index.php");
exit;