<?php

session_start();

require_once "../config/conexion.php";

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = trim($_POST["password"]);

// Campos vacios Seccion de Error
if (empty($email) || empty($password)) {
    $_SESSION["error"] = "Todos los campos son obligatorios";
    header("Location: ../views/error.php");
    exit();
}

$sql = "SELECT * FROM usuarios WHERE email=?";

$stmt = $conexion->prepare($sql);
$stmt->execute([$email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Seccion de error
if (!$usuario) {
    $_SESSION["error"] = "El usuario no está registrado";
    header("Location: ../views/error.php");
    exit();
}

if (!password_verify($password, $usuario["password"])) {
    $_SESSION["error"] = "Contraseña incorrecta";
    header("Location: ../views/error.php");
    exit();
}

$_SESSION["usuario_id"] = $usuario["id"];
$_SESSION["nombre"] = $usuario["nombre"];
$_SESSION["rol"] = $usuario["rol"];
$_SESSION["tipo"] = "warning";

header("Location: ../views/dashboard.php");
exit();
?>