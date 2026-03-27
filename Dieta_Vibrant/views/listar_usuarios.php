<?php
require_once "../config/auth.php";
require_once "../config/roles.php";
esAdmin();
require_once "../models/Usuario.php";
$u_obj = new Usuario();
$usuarios = $u_obj->listar();
$ini = strtoupper(substr($_SESSION["nombre"], 0, 2));
$colors = ['orange', 'green', 'purple', 'yellow'];
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
  <div class="page-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
  </div>

  <div class="layout">
    <aside class="sidebar">
      <div class="sb-header">
        <div class="sb-logo">
          <div class="sb-logo-icon">🥗</div>
          <div class="sb-logo-text">Nutri<span>Plan</span></div>
        </div>
        <div class="sb-user">
          <div class="sb-avatar"><?= htmlspecialchars($ini) ?></div>
          <div>
            <div class="sb-user-name"><?= htmlspecialchars($_SESSION["nombre"]) ?></div>
            <div class="sb-user-role"><?= htmlspecialchars($_SESSION["rol"]) ?></div>
          </div>
        </div>
      </div>
      <nav class="sb-nav">
        <span class="sb-group-label">Principal</span>
        <a href="dashboard.php" class="sb-link"><span class="sb-icon">🏠</span>Inicio</a>
        <a href="../controllers/MenuController.php" class="sb-link"><span class="sb-icon">🍽</span>Menú del día</a>
        <span class="sb-group-label">Mis dietas</span>
        <a href="generar_dieta.php" class="sb-link"><span class="sb-icon">✨</span>Generar dieta</a>
        <a href="listar_dietas.php" class="sb-link"><span class="sb-icon">📋</span>Historial</a>
        <span class="sb-group-label">Administración</span>
        <a href="listar_usuarios.php" class="sb-link active"><span class="sb-icon">👥</span>Usuarios</a>
      </nav>
      <div class="sb-footer">
        <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span>Cerrar sesión</a>
      </div>
    </aside>

    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Gestión de usuarios</h1>
          <p>Usuarios registrados en el sistema</p>
        </div>
      </div>

      <div class="contenido fade-up">
        <div class="table-wrap">
          <div class="table-top">
            <h2>Usuarios registrados</h2>
            <span class="table-count"><?= count($usuarios) ?> usuarios</span>
          </div>

          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Correo electrónico</th>
                <th>Rol</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($usuarios as $i => $u): ?>
                <tr>
                  <td class="td-muted" style="font-size:12px">#<?= htmlspecialchars($u["id"]) ?></td>
                  <td>
                    <div class="user-cell">
                      <div class="user-mini-av" style="background:var(--grad-<?= $colors[$i % 4] ?>)">
                        <?= strtoupper(substr($u["nombre"], 0, 2)) ?>
                      </div>
                      <span style="font-weight:600"><?= htmlspecialchars($u["nombre"]) ?></span>
                    </div>
                  </td>
                  <td class="td-muted"><?= htmlspecialchars($u["email"]) ?></td>
                  <td>
                    <?php if ($u["rol"] == "admin"): ?>
                      <span class="badge badge-purple">🛡 Administrador</span>
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