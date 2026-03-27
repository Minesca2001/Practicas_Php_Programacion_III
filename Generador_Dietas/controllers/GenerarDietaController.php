<?php

require_once "../config/conexion.php";

$usuario_id = $_GET["id"];

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);

$usuario = $stmt->fetch();

$peso = $usuario["peso"];
$altura = $usuario["altura"];
$actividad = $usuario["actividad"];
$objetivo = $usuario["objetivo"];

$imc = $peso / ($altura * $altura);

// Calculo calorias base
$calorias = $peso * 24;

// Factor actividad
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

    case "Activo":
        $calorias *= 1.725;
        break;

}

// Ajuste por objetivo
if ($objetivo == "Perder") {
    $calorias -= 500;
}

if ($objetivo == "Ganar") {
    $calorias += 500;
}

// Generar dieta
$dieta = "
Desayuno:
Avena con frutas y yogurt

Almuerzo:
Pollo a la plancha con arroz integral y ensalada

Cena:
Pescado con vegetales

Snack:
Frutas o frutos secos
";

// Guardar dieta
$sql = "INSERT INTO dietas (usuario_id,calorias,descripcion)
VALUES (?,?,?)";

$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id, $calorias, $dieta]);

header("Location: ../views/listar_dietas.php");
?>