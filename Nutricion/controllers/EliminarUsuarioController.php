<?php

require_once "../config/conexion.php";

$id = $_GET["id"];

$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);

header("Location: ../views/listar_usuarios.php");

?>