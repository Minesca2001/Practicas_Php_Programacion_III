<?php

require_once "../models/Dieta.php";

$peso = $_POST["peso"];
$altura = $_POST["altura"];
$edad = $_POST["edad"];
$genero = $_POST["genero"];
$actividad = $_POST["actividad"];
$objetivo = $_POST["objetivo"];

$dieta = new Dieta();

$calorias = $dieta->calcularCalorias($peso, $altura, $edad, $genero, $actividad, $objetivo);

echo "Calorías recomendadas: " . $calorias;

?>