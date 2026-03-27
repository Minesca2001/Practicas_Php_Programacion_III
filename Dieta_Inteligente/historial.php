<?php
require_once 'session.php';
header('Content-Type: application/json');
if(!isset($_SESSION['user'])){ http_response_code(401); die(json_encode(['success'=>false])); }
// devuelve ejemplo
echo json_encode(['success'=>true,'data'=>[
 ['id'=>1,'nombre'=>'Dieta 1','fecha'=>'2023-10-01'],
 ['id'=>2,'nombre'=>'Dieta 2','fecha'=>'2023-10-05']
]]);