<?php

require_once "../models/Alimento.php";

$alimento = new Alimento();

$desayuno = $alimento->obtenerPorTipo("desayuno");
$almuerzo = $alimento->obtenerPorTipo("almuerzo");
$cena = $alimento->obtenerPorTipo("cena");

include "../views/menu.php";

?>