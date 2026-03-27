<?php

require_once "../models/Usuario.php";

$usuario = new Usuario();

if (isset($_POST["guardar"])) {

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $peso = $_POST["peso"];
    $altura = $_POST["altura"];
    $genero = $_POST["genero"];
    $actividad = $_POST["actividad"];
    $objetivo = $_POST["objetivo"];

    $usuario->guardar(
        $nombre,
        $email,
        $password,
        $peso,
        $altura,
        $genero,
        $actividad,
        $objetivo
    );

    header("Location: ../views/listar_usuarios.php");
    exit();

}
if (isset($_POST["logout"])) {
    session_destroy();

    header("Location: ../views/login.php");

}

?>