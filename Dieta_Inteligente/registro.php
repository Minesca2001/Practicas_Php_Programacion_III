<?php
require_once 'session.php';
header('Content: application/json');
$input = json_decode(file_get_contents('php://input'),true);
$nombre = $input['nombre'] ?? '';
$email = $input['email'] ?? '';
$pass = $input['password'] ?? '';
// ejemplo simple
$_SESSION['user']=['id'=>2,'nombre'=>$nombre,'role'=>'user'];
echo json_encode(['success=>true']);