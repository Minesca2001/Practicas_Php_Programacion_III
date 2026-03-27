<?php
require_once 'session.php';
header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD']==='DELETE'){ session_destroy(); echo json_encode(['success']); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
  $input = json_decode(file_get_contents('php://input'),true);
  $email = $input['email'] ?? '';
  $pass = $input['password'] ?? '';
  // ejemplo simple
  if($email==='admin@mail.com' && $pass=== '123456'){
    $_SESSION['user']=['id'=>1,'nombre'=>'Admin','role'=>'admin'];
    echo json_encode(['success'=>true]);
  } else {
    echo json_encode(['success'=>false,'error'=>'Credenciales inválidas']);
  }
  exit;
}
if(isset($_SESSION['user'])){ echo json_encode(['success'=>true,'user'=>$_SESSION['user']]); }
else { echo json_encode(['success=>false']); }