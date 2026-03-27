<?php
require_once "../config/auth.php";
require_once "../config/roles.php";
esAdmin();
require_once "../models/Usuario.php";
$usuario = new Usuario();
$usuarios = $usuario->listar();
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 2));
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

  <aside class="sidebar">
    <div class="sb-top">
      <div class="sb-logo">
        <div class="sb-logo-icon">🥗</div>
        <span class="sb-logo-name">NutriPlan</span>
      </div>
      <div class="sb-user">
        <div class="sb-avatar"><?= htmlspecialchars($inicial) ?></div>
        <div class="sb-user-info">
          <div class="uname"><?= htmlspecialchars($_SESSION["nombre"]) ?></div>
          <div class="urole"><?= htmlspecialchars($_SESSION["rol"]) ?></div>
        </div>
      </div>
    </div>
    <nav class="sb-nav">
      <span class="sb-section">Principal</span>
      <a href="dashboard.php" class="sb-link"><span class="icon">🏠</span> Inicio</a>
      <a href="../controllers/MenuController.php" class="sb-link"><span class="icon">🍽</span> Menú del día</a>
      <span class="sb-section">Dietas</span>
      <a href="generar_dieta.php" class="sb-link"><span class="icon">✨</span> Generar dieta</a>
      <a href="listar_dietas.php" class="sb-link"><span class="icon">📋</span> Historial</a>
      <span class="sb-section">Admin</span>
      <a href="listar_usuarios.php" class="sb-link active"><span class="icon">👥</span> Usuarios</a>
    </nav>
    <div class="sb-footer">
      <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span> Cerrar sesión</a>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">Gestión de usuarios</div>
        <div class="topbar-subtitle">Todos los usuarios registrados en el sistema</div>
      </div>
    </div>

    <div class="contenido fade-up">
      <div class="tbl-wrap">
        <div class="tbl-head">
          <h2>Usuarios</h2>
          <span class="tbl-count"><?= count($usuarios) ?> registrados</span>
        </div>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Correo electrónico</th>
              <th>Rol</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $u): ?>
            <tr>
              <td style="color:var(--text-3);font-size:12px">#<?= htmlspecialchars($u["id"]) ?></td>
              <td>
                <div style="display:flex;align-items:center;gap:10px">
                  <div style="width:30px;height:30px;background:rgba(0,200,150,0.1);border:1px solid rgba(0,200,150,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;color:var(--emerald)">
                    <?= strtoupper(substr($u["nombre"], 0, 2)) ?>
                  </div>
                  <?= htmlspecialchars($u["nombre"]) ?>
                </div>
              </td>
              <td style="color:var(--text-2)"><?= htmlspecialchars($u["email"]) ?></td>
              <td>
                <?php if ($u["rol"] == "admin"): ?>
                  <span class="badge badge-admin">🛡 Admin</span>
                <?php else: ?>
                  <span class="badge badge-green">👤 Usuario</span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
