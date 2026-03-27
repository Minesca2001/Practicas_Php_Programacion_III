<?php
header('Content-Type: application/json');
require_once 'session.php';
$role = $_SESSION['user']['role'] ?? 'user';
$menu = [
  'user' => [
    ['label'=>'Dashboard','href'=>'/dashboard'],
    ['label'=>'Generar Dieta','href'=>'/generar_dieta'],
    ['label'=>'Historial','href'=>'/historial'],
    ['label'=>'Salir','href'=>'#','logout'=>true]
  ],
  'admin' => [
    ['label'=>'Dashboard','href'=>'/dashboard'],
    ['label'=>'Generar Dieta','href'=>'/generar_dieta'],
    ['label'=>'Historial','href'=>'/historial'],
    ['label'=>'Dietas','href'=>'/dietas'],
    ['label'=>'Usuarios','href'=>'/usuarios'],
    ['label'=>'Salir','href'=>'#','logout'=>true]
  ]
];
echo json_encode($menu[$role] ?? []);
?>