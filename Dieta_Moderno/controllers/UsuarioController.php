<?php

require_once "../models/Usuario.php";

$usuario = new Usuario();

if (isset($_POST["guardar"])) {

    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $rol = "usuario";

    $usuario->guardar($nombre, $email, $password, $rol);

    header("Location: ../views/login.php");

}

?>