<?php
require_once "../config/auth.php";
require_once "../config/roles.php";

esAdmin();

require_once "../models/Usuario.php";

$usuario = new Usuario();
$usuarios = $usuario->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios — NutriPlan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="layout">

    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-name">NutriPlan</div>
            <div class="brand-sub">Sistema de Nutrición</div>
        </div>
        <div class="sidebar-user">
            <div class="user-name"><?php echo htmlspecialchars($_SESSION["nombre"]); ?></div>
            <div class="user-tag"><?php echo htmlspecialchars($_SESSION["rol"]); ?></div>
        </div>
        <nav class="sidebar-nav">
            <span class="nav-label">Principal</span>
            <a href="dashboard.php">🏠 Inicio</a>
            <a href="../controllers/MenuController.php">🍽 Menú diario</a>
            <span class="nav-label">Dietas</span>
            <a href="generar_dieta.php">✨ Generar dieta</a>
            <a href="listar_dietas.php">📋 Historial</a>
            <span class="nav-label">Administración</span>
            <a href="listar_usuarios.php">👥 Usuarios</a>
        </nav>
        <div class="sidebar-footer">
            <a href="../controllers/LogoutController.php">⬅ Cerrar sesión</a>
        </div>
    </div>

    <div class="contenido">
        <div class="page-header">
            <h1>Gestión de usuarios</h1>
            <p>Todos los usuarios registrados en el sistema.</p>
        </div>

        <div class="table-wrapper">
            <div class="table-header">
                <h2>Usuarios</h2>
                <span class="table-count"><?= count($usuarios) ?> registrados</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td>#<?= htmlspecialchars($u["id"]) ?></td>
                        <td><?= htmlspecialchars($u["nombre"]) ?></td>
                        <td><?= htmlspecialchars($u["email"]) ?></td>
                        <td>
                            <?php if ($u["rol"] == "admin"): ?>
                                <span class="badge badge-sand">Admin</span>
                            <?php else: ?>
                                <span class="badge badge-green">Usuario</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
