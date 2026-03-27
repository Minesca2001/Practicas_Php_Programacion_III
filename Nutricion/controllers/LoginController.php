<?php

session_start();

require_once "../config/conexion.php";

// Limpieza básica de datos
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password']);

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {

    // Validar contraseña
    if (password_verify($password, $usuario["password"])) {

        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["rol"];

        header("Location: ../views/dashboard.php");
        exit();

    } else {

        echo "Contraseña incorrecta";

    }

} else {

    echo "Usuario no encontrado";

}

?>