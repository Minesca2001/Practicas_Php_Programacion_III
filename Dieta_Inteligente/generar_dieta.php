<?php
require_once 'session.php';
header('Content-Type: application/json');
if(!isset($_SESSION['user'])){ http_response_code(401); die(json_encode(['success'=>false])); }
$input = json_decode(file_get_contents('php://input'),true);
// ejemplo simple
echo json_encode(['success'=>true]);