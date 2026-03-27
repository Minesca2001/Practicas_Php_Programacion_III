<?php
require_once "../middleware/auth.php";
require_once "../models/Dieta.php";

$dieta = new Dieta();
$datos = $dieta->listar();

foreach ($datos as $fila) {

    echo $fila["nombre"] . " - ";
    echo $fila["calorias"] . " calorias - ";
    echo $fila["descripcion"] . "<br>";

}

?>