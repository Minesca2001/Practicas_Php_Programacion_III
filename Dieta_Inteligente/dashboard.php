<?php
require_once 'session.php';
header('Content-Type: application/json');
if(!isset($_SESSION['user'])){ http_response_code(401); die(json_encode(['success'=>false])); }
echo json_encode(['success'=>true,'user'=>$_SESSION['user']]);