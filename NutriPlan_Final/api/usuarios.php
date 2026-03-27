<?php
header("Content-Type: application/json; charset=utf-8");
session_start();
require_once "../config/conexion.php";

if (!isset($_SESSION["usuario_id"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(403);
    echo json_encode(["error"=>"Acceso denegado"]);
    exit();
}

$sql = "SELECT id, nombre, email, rol FROM usuarios ORDER BY id ASC";
$stmt = $conexion->query($sql);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
