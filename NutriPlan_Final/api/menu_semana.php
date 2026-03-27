<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

// Pool amplio de alimentos por tipo de comida
$desayunos_pool = [
  [["nombre"=>"Avena con plátano y miel",           "calorias"=>340],["nombre"=>"Yogur griego con fresas","calorias"=>130],["nombre"=>"Café negro",                   "calorias"=>5]],
  [["nombre"=>"Tostadas integrales con aguacate",   "calorias"=>280],["nombre"=>"Huevos revueltos (2)","calorias"=>160],["nombre"=>"Jugo de naranja natural",       "calorias"=>90]],
  [["nombre"=>"Smoothie de espinaca y mango",       "calorias"=>210],["nombre"=>"Galletas de avena (3 piezas)","calorias"=>120],["nombre"=>"Almendras (20g)",          "calorias"=>115]],
  [["nombre"=>"Panqueques de avena y banana",       "calorias"=>380],["nombre"=>"Fresas frescas (1 taza)","calorias"=>50], ["nombre"=>"Té verde",                     "calorias"=>2]],
  [["nombre"=>"Huevos pochados sobre espinaca",     "calorias"=>200],["nombre"=>"Tostada de centeno",   "calorias"=>80],  ["nombre"=>"Fruta de temporada",          "calorias"=>70]],
  [["nombre"=>"Granola casera con leche descremada","calorias"=>320],["nombre"=>"Manzana verde",         "calorias"=>52],  ["nombre"=>"Jugo de zanahoria",           "calorias"=>95]],
  [["nombre"=>"Omelet de vegetales (3 huevos)",     "calorias"=>280],["nombre"=>"Papaya en trozos",      "calorias"=>60],  ["nombre"=>"Café con leche descremada",   "calorias"=>45]],
];

$almuerzos_pool = [
  [["nombre"=>"Pechuga de pollo a la plancha",      "calorias"=>220],["nombre"=>"Arroz integral (1 taza)","calorias"=>216],["nombre"=>"Ensalada de espinaca",        "calorias"=>30], ["nombre"=>"Aguacate (½)",                 "calorias"=>80]],
  [["nombre"=>"Salmón al horno con limón",          "calorias"=>250],["nombre"=>"Quinoa cocida (¾ taza)","calorias"=>167],["nombre"=>"Brócoli al vapor",            "calorias"=>34], ["nombre"=>"Tomates cherry",               "calorias"=>18]],
  [["nombre"=>"Lentejas estofadas",                 "calorias"=>230],["nombre"=>"Arroz blanco (½ taza)", "calorias"=>130],["nombre"=>"Ensalada mixta",              "calorias"=>25]],
  [["nombre"=>"Filete de pavo a la plancha",        "calorias"=>200],["nombre"=>"Batata asada",           "calorias"=>86], ["nombre"=>"Espinaca salteada con ajo",  "calorias"=>40]],
  [["nombre"=>"Atún en ensalada mediterránea",      "calorias"=>180],["nombre"=>"Pan pita integral",      "calorias"=>170],["nombre"=>"Vegetales crudos",           "calorias"=>50]],
  [["nombre"=>"Pollo al curry con vegetales",       "calorias"=>300],["nombre"=>"Arroz basmati integral", "calorias"=>200],["nombre"=>"Raita de pepino",            "calorias"=>60]],
  [["nombre"=>"Carne de res magra asada (150g)",    "calorias"=>270],["nombre"=>"Puré de batata",         "calorias"=>130],["nombre"=>"Ensalada de tomate y pepino","calorias"=>35]],
];

$cenas_pool = [
  [["nombre"=>"Sopa de lentejas con espinaca",      "calorias"=>180],["nombre"=>"Tostada integral",       "calorias"=>80], ["nombre"=>"Yogur griego (100g)",        "calorias"=>97]],
  [["nombre"=>"Pescado tilapia al vapor",           "calorias"=>128],["nombre"=>"Vegetales salteados",    "calorias"=>70], ["nombre"=>"Arroz integral (½ taza)",    "calorias"=>108]],
  [["nombre"=>"Pechuga de pollo al horno",          "calorias"=>185],["nombre"=>"Brócoli con ajo",        "calorias"=>50], ["nombre"=>"Camote asado",              "calorias"=>86]],
  [["nombre"=>"Tortilla española (2 huevos)",       "calorias"=>210],["nombre"=>"Ensalada verde grande",  "calorias"=>40]],
  [["nombre"=>"Crema de zanahoria y jengibre",      "calorias"=>120],["nombre"=>"Pan integral (1 rebanada)","calorias"=>70],["nombre"=>"Queso fresco bajo en grasa","calorias"=>100]],
  [["nombre"=>"Salmón al vapor con limón",          "calorias"=>200],["nombre"=>"Espárragos asados",      "calorias"=>40], ["nombre"=>"Quinoa (½ taza)",           "calorias"=>111]],
  [["nombre"=>"Wrap de pavo con lechuga",           "calorias"=>280],["nombre"=>"Fruta fresca de temporada","calorias"=>65]],
];

// Generar menú aleatorio pero reproducible por día de la semana
// Usamos la semana del año como semilla para variedad semanal
$semana = (int)date("W");
$anio   = (int)date("Y");

$menu = [];
for ($dia = 0; $dia < 7; $dia++) {
  // Índice pseudo-aleatorio pero estable por día/semana
  $idx_d = ($semana + $dia * 3 + $anio) % count($desayunos_pool);
  $idx_a = ($semana + $dia * 5 + $anio) % count($almuerzos_pool);
  $idx_c = ($semana + $dia * 7 + $anio) % count($cenas_pool);

  $des = $desayunos_pool[$idx_d];
  $alm = $almuerzos_pool[$idx_a];
  $cen = $cenas_pool[$idx_c];

  $total = array_sum(array_column($des,"calorias"))
         + array_sum(array_column($alm,"calorias"))
         + array_sum(array_column($cen,"calorias"));

  $menu[] = [
    "dia"       => $dia,
    "desayuno"  => $des,
    "almuerzo"  => $alm,
    "cena"      => $cen,
    "totalKcal" => $total,
  ];
}

echo json_encode($menu, JSON_UNESCAPED_UNICODE);
