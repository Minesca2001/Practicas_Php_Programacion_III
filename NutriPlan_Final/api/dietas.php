<?php
header("Content-Type: application/json; charset=utf-8");
session_start();
require_once "../config/conexion.php";

if (!isset($_SESSION["usuario_id"])) {
    http_response_code(401);
    echo json_encode(["error"=>"No autorizado"]);
    exit();
}

$uid = $_SESSION["usuario_id"];
$sql = "SELECT * FROM dietas WHERE usuario_id = ? ORDER BY fecha DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute([$uid]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
