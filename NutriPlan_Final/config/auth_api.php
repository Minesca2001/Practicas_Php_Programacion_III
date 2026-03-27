<?php
if (!isset($_SESSION['usuario_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['ok'=>false,'msg'=>'No autenticado','redirect'=>'../views/login.php']);
    exit();
}
