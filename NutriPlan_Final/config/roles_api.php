<?php
function esAdminApi()
{
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        header('Content-Type: application/json');
        echo json_encode(['ok' => false, 'msg' => 'Sin permisos de administrador']);
        exit();
    }
}
