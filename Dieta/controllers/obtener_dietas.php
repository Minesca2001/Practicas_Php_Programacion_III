<?php
session_start();
require_once "../config/conexion.php";

header('Content-Type: application/json');

$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT * FROM dietas WHERE usuario_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);

$dietas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($dietas);