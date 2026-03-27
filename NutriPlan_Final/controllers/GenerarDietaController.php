<?php
require_once "../config/auth.php";
require_once "../config/conexion.php";

if (!isset($_SESSION["usuario_id"])) {
  header("Location: ../views/login.php");
  exit();
}

$uid = $_SESSION["usuario_id"];
$peso = floatval($_POST["peso"] ?? 0);
$alturaM = floatval($_POST["altura"] ?? 0);
$edad = intval($_POST["edad"] ?? 0);
$genero = $_POST["genero"] ?? "Masculino";
$actividad = $_POST["actividad"] ?? "Moderado";
$objetivo = $_POST["objetivo"] ?? "Mantener";

if ($peso <= 0 || $alturaM <= 0 || $edad <= 0) {
  $_SESSION["error"] = "Por favor completa todos los campos correctamente.";
  header("Location: ../views/error.php");
  exit();
}

// ── IMC ─────────────────────────────────────────────
$imc = round($peso / ($alturaM * $alturaM), 2);

// ── Calorías (Harris-Benedict revisado) ─────────────
if ($genero === "Masculino") {
  $bmr = 88.36 + (13.4 * $peso) + (4.8 * ($alturaM * 100)) - (5.7 * $edad);
} else {
  $bmr = 447.6 + (9.2 * $peso) + (3.1 * ($alturaM * 100)) - (4.3 * $edad);
}
$factores = ["Sedentario" => 1.2, "Ligero" => 1.375, "Moderado" => 1.55, "Intenso" => 1.725];
$calorias = $bmr * ($factores[$actividad] ?? 1.2);
if ($objetivo === "Perder")
  $calorias -= 500;
if ($objetivo === "Ganar")
  $calorias += 500;
$calorias = round($calorias);

// ── Banco de alimentos variados ──────────────────────
$alimentos = [
  "desayuno" => [
    ["Avena integral con plátano y miel", 280, "cereales"],
    ["Huevos revueltos con espinaca", 210, "proteínas"],
    ["Tostadas integrales con aguacate", 250, "grasas"],
    ["Yogur griego con fresas y granola", 320, "lácteos"],
    ["Smoothie de mango, espinaca y proteína", 300, "frutas"],
    ["Panqueques de avena con arándanos", 340, "cereales"],
    ["Omelet de 3 huevos con tomates cherry", 260, "proteínas"],
  ],
  "almuerzo" => [
    ["Pechuga de pollo a la plancha", 165, "proteínas"],
    ["Salmón atlántico al horno con limón", 208, "proteínas"],
    ["Atún en ensalada mediterránea", 160, "proteínas"],
    ["Filete de pavo con vegetales salteados", 200, "proteínas"],
    ["Lentejas estofadas con arroz integral", 350, "legumbres"],
    ["Carne de res magra asada (150g)", 270, "proteínas"],
    ["Pollo al curry ligero con vegetales", 300, "proteínas"],
  ],
  "acomp" => [
    ["Arroz integral (1 taza)", 216, "cereales"],
    ["Quinoa cocida (¾ taza)", 167, "cereales"],
    ["Batata asada (1 mediana)", 86, "tubérculos"],
    ["Brócoli al vapor", 34, "vegetales"],
    ["Espinaca salteada con ajo", 40, "vegetales"],
    ["Ensalada mixta grande", 30, "vegetales"],
  ],
  "cena" => [
    ["Sopa de lentejas con espinaca", 180, "legumbres"],
    ["Pescado tilapia al vapor", 128, "proteínas"],
    ["Pechuga de pollo al horno (120g)", 185, "proteínas"],
    ["Salmón al vapor con limón y eneldo", 200, "proteínas"],
    ["Tortilla española de claras", 175, "proteínas"],
    ["Wrap de pavo con lechuga y tomate", 280, "proteínas"],
    ["Crema de zanahoria y jengibre", 120, "vegetales"],
  ],
  "snack" => [
    ["Almendras (25g)", 144, "frutos secos"],
    ["Manzana verde mediana", 52, "frutas"],
    ["Yogur griego natural (120g)", 97, "lácteos"],
    ["Fresas frescas (1 taza)", 50, "frutas"],
    ["Nueces (20g)", 131, "frutos secos"],
  ],
];

// Selección seeded por usuario + fecha para variedad reproducible
srand(crc32($_SESSION["usuario_id"] . date("Ymd")));
function pick($pool)
{
  return $pool[array_rand($pool)];
}

$des = pick($alimentos["desayuno"]);
$alm = pick($alimentos["almuerzo"]);
$ac1 = pick($alimentos["acomp"]);
$ac2 = $alimentos["acomp"][array_rand($alimentos["acomp"])];
while ($ac2[0] === $ac1[0])
  $ac2 = pick($alimentos["acomp"]);
$cen = pick($alimentos["cena"]);
$sn1 = pick($alimentos["snack"]);
$sn2 = pick($alimentos["snack"]);

// ── Etiqueta IMC ────────────────────────────────────
$imc_label = match (true) {
  $imc < 18.5 => "Bajo peso — considera aumentar calorías gradualmente",
  $imc < 25 => "Peso normal — excelente, mantén estos hábitos",
  $imc < 30 => "Sobrepeso leve — un déficit moderado es recomendable",
  default => "Obesidad — busca orientación médica profesional",
};

// ── Descripción del plan ─────────────────────────────
$desc = "═══════ PLAN NUTRICIONAL PERSONALIZADO ═══════

📊 DATOS CALCULADOS
• IMC: {$imc} — {$imc_label}
• Calorías diarias: {$calorias} kcal
• Objetivo: {$objetivo} peso · Actividad: {$actividad}
• Género: {$genero} · Edad: {$edad} años

🌅 DESAYUNO (~" . $des[1] . " kcal)
• {$des[0]}
• Fruta de temporada (naranja, papaya o kiwi)
• Bebida: agua, té verde o café negro

☀️ ALMUERZO (~" . ($alm[1] + $ac1[1]) . " kcal)
• {$alm[0]}
• {$ac1[0]}
• {$ac2[0]}
• Agua o agua con limón (2 vasos)

🌙 CENA (~" . $cen[1] . " kcal)
• {$cen[0]}
• Ensalada ligera de temporada

🍎 SNACKS (máximo 2 al día)
• {$sn1[0]} (~{$sn1[1]} kcal)
• {$sn2[0]} (~{$sn2[1]} kcal)

💧 HIDRATACIÓN
• Mínimo 8 vasos de agua al día (2 litros)
• Evita bebidas azucaradas y alcohol

⚠️ NOTA IMPORTANTE
Este plan es orientativo y generado algorítmicamente.
Consulta con un nutricionista certificado para ajustes personalizados.";

// ── Guardar ──────────────────────────────────────────
$sql = "INSERT INTO dietas (usuario_id, peso, altura, edad, genero, actividad, objetivo, imc, calorias, descripcion)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->execute([$uid, $peso, $alturaM, $edad, $genero, $actividad, $objetivo, $imc, $calorias, $desc]);

header("Location: ../views/listar_dietas.php");
exit();
