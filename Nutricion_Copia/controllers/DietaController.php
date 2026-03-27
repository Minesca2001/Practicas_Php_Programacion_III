<?php

require_once "../models/Dieta.php";

$dieta = new Dieta();

if (isset($_POST["guardar"])) {

    $dieta->guardar(
        $_POST["usuario_id"],
        $_POST["calorias"],
        $_POST["descripcion"]
    );

    header("Location: ../views/listar_dietas.php");

}

?>