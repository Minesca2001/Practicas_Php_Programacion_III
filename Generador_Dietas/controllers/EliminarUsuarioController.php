<?php

require_once "../models/Usuario.php";

$usuario = new Usuario();

if (isset($_POST["guardar"])) {

    $usuario->guardar(
        $_POST["nombre"],
        $_POST["email"],
        $_POST["peso"],
        $_POST["altura"],
        $_POST["genero"],
        $_POST["actividad"],
        $_POST["objetivo"]
    );

    header("Location: ../views/listar_usuarios.php");

}

?>