<?php
// Llamar: setActive("dash"|"menu"|"dietas"|"gen"|"usuarios"|"alimentos")
function setActive($page)
{
  global $_ACTIVE_PAGE;
  $_ACTIVE_PAGE = $page;
}
function isActive($page)
{
  global $_ACTIVE_PAGE;
  return $_ACTIVE_PAGE === $page ? "active" : "";
}
?>
<aside class="sidebar">
  <div class="sb-header">
    <div class="sb-logo">
      <div class="sb-logo-icon">🥗</div>
      <div class="sb-logo-text">Nutri<span>Plan</span></div>
    </div>
    <div class="sb-user">
      <div class="sb-avatar"><?= htmlspecialchars(strtoupper(substr($_SESSION["nombre"], 0, 2))) ?></div>
      <div>
        <div class="sb-user-name"><?= htmlspecialchars($_SESSION["nombre"]) ?></div>
        <div class="sb-user-role"><?= htmlspecialchars($_SESSION["rol"]) ?></div>
      </div>
    </div>
  </div>
  <nav class="sb-nav">
    <span class="sb-group-label">Principal</span>
    <a href="dashboard.php" class="sb-link <?= isActive('dash') ?>"><span class="sb-icon">🏠</span>Inicio</a>
    <a href="menu.php" class="sb-link <?= isActive('menu') ?>"><span class="sb-icon">🍽</span>Menú semanal</a>
    <a href="alimentos.php" class="sb-link <?= isActive('alimentos') ?>"><span class="sb-icon">🥑</span>Alimentos</a>
    <span class="sb-group-label">Mis dietas</span>
    <a href="generar_dieta.php" class="sb-link <?= isActive('gen') ?>"><span class="sb-icon">✨</span>Generar dieta</a>
    <a href="listar_dietas.php" class="sb-link <?= isActive('dietas') ?>"><span class="sb-icon">📋</span>Historial</a>
    <?php if ($_SESSION["rol"] == "admin"): ?>
      <span class="sb-group-label">Administración</span>
      <a href="listar_usuarios.php" class="sb-link <?= isActive('usuarios') ?>"><span
          class="sb-icon">👥</span>Usuarios</a>
    <?php endif; ?>
  </nav>
  <div class="sb-footer">
    <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span>Cerrar sesión</a>
  </div>
</aside>