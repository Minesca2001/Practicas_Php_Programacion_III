<?php

session_start();
require_once "../models/Alimento.php";

$alimento = new Alimento();

// 🔐 Validar que venga el formulario
if (!isset($_POST["objetivo"])) {
    $_SESSION["error"] = "Debes seleccionar un objetivo";
    header("Location: ../views/error.php");
    exit();
}

// 🔐 Limpiar dato
$objetivo = htmlspecialchars(trim($_POST["objetivo"]));

// 🔥 OPCIÓN 1: MENÚ DESDE BASE DE DATOS (RECOMENDADO)
try {

    $menu = [
        "desayuno" => $alimento->obtenerPorTipo("desayuno"),
        "media_manana" => $alimento->obtenerPorTipo("media"),
        "almuerzo" => $alimento->obtenerPorTipo("almuerzo"),
        "merienda" => $alimento->obtenerPorTipo("merienda"),
        "cena" => $alimento->obtenerPorTipo("cena")
    ];

    // ❌ Si la BD no devuelve datos
    if (!$menu["desayuno"] || !$menu["almuerzo"] || !$menu["cena"]) {

        // 🔥 fallback (plan B)
        $menu = generarMenuPorObjetivo($objetivo);
    }

} catch (Exception $e) {

    // 🔥 fallback si falla BD
    $menu = generarMenuPorObjetivo($objetivo);
}

// ✅ Guardar en sesión
$_SESSION["menu"] = $menu;

// 🔄 Redirigir a la vista
header("Location: ../views/menu.php");
exit();


// ============================
// 🔥 FUNCIÓN AUXILIAR
// ============================
function generarMenuPorObjetivo($objetivo)
{

    if ($objetivo == "perder") {

        return [
            "desayuno" => "Avena con frutas",
            "media_manana" => "Manzana",
            "almuerzo" => "Pollo a la plancha + ensalada",
            "merienda" => "Yogur light",
            "cena" => "Vegetales"
        ];

    } elseif ($objetivo == "ganar") {

        return [
            "desayuno" => "Avena + huevo + banana",
            "media_manana" => "Batido de proteína",
            "almuerzo" => "Arroz + carne + aguacate",
            "merienda" => "Pan + mantequilla de maní",
            "cena" => "Pollo + pasta"
        ];

    } else {

        return [
            "desayuno" => "Pan integral + huevo",
            "media_manana" => "Fruta",
            "almuerzo" => "Arroz + pollo",
            "merienda" => "Yogur",
            "cena" => "Ensalada + proteína"
        ];
    }
}