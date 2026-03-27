<?php
require_once 'session.php';
header('Content-Type: application/json');
if(!isset($_SESSION['user']) || ($_SESSION['user']['role']!=='admin')){ http_response_code(403); die(json_encode(['success=>false])); }
else echo json_encode(['success'=>true,'data'=>])
 ['id'=>1,'nombre'=>'Admin','email'=>'admin@mail.com','fecha_registro'=>'2023-10-01'],
]]);