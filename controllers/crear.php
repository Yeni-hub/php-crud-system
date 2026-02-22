<?php
require_once "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql = "INSERT INTO perfiles
    (nombre_completo, documento, email, telefono, direccion, rol, estado)
    VALUES
    (:nombre, :documento, :email, :telefono, :direccion, :rol, :estado)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre"    => trim($_POST["nombre_completo"]),
        ":documento" => trim($_POST["documento"]),
        ":email"     => trim($_POST["email"]),
        ":telefono"  => trim($_POST["telefono"]),
        ":direccion" => trim($_POST["direccion"]),
        ":rol"       => $_POST["rol"],
        ":estado"    => $_POST["estado"]
    ]);

    header("Location: ../index.php");
}