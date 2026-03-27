<?php

session_start();
require_once "../config/conexion.php";

// Usuario logueado
$usuario_id = $_SESSION["usuario_id"];

// Datos del formulario
$peso = $_POST["peso"] ?? 0;
$altura = $_POST["altura"] ?? 0;
$edad = $_POST["edad"] ?? 0;
$genero = $_POST["genero"] ?? "";
$actividad = $_POST["actividad"] ?? "";
$objetivo = $_POST["objetivo"] ?? "";

// Validación
if ($peso <= 0 || $altura <= 0) {
    die("Error: datos inválidos");
}

// Si usas cm → convertir a metros
$altura = $altura / 100;

// IMC
$imc = $peso / ($altura * $altura);

// Calorías base
$calorias = $peso * 24;

// Actividad
switch ($actividad) {
    case "Sedentario":
        $calorias *= 1.2;
        break;
    case "Ligero":
        $calorias *= 1.375;
        break;
    case "Moderado":
        $calorias *= 1.55;
        break;
    case "Intenso":
        $calorias *= 1.725;
        break;
}

// Objetivo
if ($objetivo == "Perder") {
    $calorias -= 500;
} elseif ($objetivo == "Ganar") {
    $calorias += 500;
}

// Dieta
$dieta = "
Desayuno: Avena con frutas y yogurt
Almuerzo: Pollo a la plancha con arroz integral
Cena: Pescado con vegetales
Snack: Frutas o frutos secos
";

// Guardar en BD
$sql = "INSERT INTO dietas 
(usuario_id, peso, altura, edad, genero, actividad, objetivo, imc, calorias, descripcion)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->execute([
    $usuario_id,
    $peso,
    $altura,
    $edad,
    $genero,
    $actividad,
    $objetivo,
    $imc,
    $calorias,
    $dieta
]);

header("Location: ../views/listar_dietas.php");
exit();