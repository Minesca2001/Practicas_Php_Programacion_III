<?php
// $active variable: dash|menu|generar|historial|usuarios|alimentos
require_once "../config/auth.php";
$active = $active ?? '';
$ini = $ini ?? strtoupper(substr($_SESSION["nombre"] ?? '??', 0, 2));
?>
<aside class="sidebar">
  <div class="sb-header">
    <div class="sb-logo">
      <div class="sb-logo-icon">🥗</div>
      <div class="sb-logo-text">Nutri<span>Plan</span></div>
    </div>
    <div class="sb-user">
      <div class="sb-avatar"><?= htmlspecialchars($ini) ?></div>
      <div>
        <div class="sb-user-name"><?= htmlspecialchars($_SESSION["nombre"] ?? '') ?></div>
        <div class="sb-user-role"><?= htmlspecialchars($_SESSION["rol"] ?? '') ?></div>
      </div>
    </div>
  </div>
  <nav class="sb-nav">
    <span class="sb-group-label">Principal</span>
    <a href="dashboard.php" class="sb-link <?= $active === 'dash' ? 'active' : '' ?>"><span
        class="sb-icon">🏠</span>Inicio</a>
    <a href="../controllers/MenuController.php" class="sb-link <?= $active === 'menu' ? 'active' : '' ?>"><span
        class="sb-icon">🍽</span>Menú semanal</a>
    <a href="alimentos.php" class="sb-link <?= $active === 'alimentos' ? 'active' : '' ?>"><span
        class="sb-icon">🥑</span>Panel de alimentos</a>
    <span class="sb-group-label">Mis dietas</span>
    <a href="generar_dieta.php" class="sb-link <?= $active === 'generar' ? 'active' : '' ?>"><span
        class="sb-icon">✨</span>Generar dieta</a>
    <a href="listar_dietas.php" class="sb-link <?= $active === 'historial' ? 'active' : '' ?>"><span
        class="sb-icon">📋</span>Historial</a>
    <?php if (($_SESSION["rol"] ?? '') === 'admin'): ?>
      <span class="sb-group-label">Administración</span>
      <a href="listar_usuarios.php" class="sb-link <?= $active === 'usuarios' ? 'active' : '' ?>"><span
          class="sb-icon">👥</span>Usuarios</a>
    <?php endif; ?>
  </nav>
  <div class="sb-footer">
    <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span>Cerrar sesión</a>
  </div>
</aside>