<?php

session_start();
require_once "../models/Usuario.php";

$usuario = new Usuario();

if (isset($_POST["guardar"])) {
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);
    $confirmar = trim($_POST["confirmar"]);
    $rol = "usuario";

    // Campos vacíos
    if (empty($nombre) || empty($email) || empty($password) || empty($confirmar)) {
        $_SESSION["error"] = "Todos los campos son obligatorios";
        header("Location: ../views/error.php");
        exit();
    }

    // Email inválido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Correo inválido";
        header("Location: ../views/error.php");
        exit();
    }

    // Contraseñas no coinciden
    if ($password !== $confirmar) {
        $_SESSION["error"] = "Las contraseñas no coinciden";
        header("Location: ../views/error.php");
        exit();
    }

    // Verificar si el email ya existe
    if ($usuario->existeEmail($email)) {
        $_SESSION["error"] = "El email ya está registrado";
        header("Location: ../views/error.php");
        exit();
    }

    // Encriptar contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Guardar usuario
    $usuario->guardar($nombre, $email, $passwordHash, $rol);

    header("Location: ../views/login.php");
    exit();
}

?>