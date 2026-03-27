<?php require_once "../config/auth.php";
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 2)); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú del Día — NutriPlan</title>
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
      <a href="../controllers/MenuController.php" class="sb-link active"><span class="icon">🍽</span> Menú del día</a>
      <span class="sb-section">Dietas</span>
      <a href="generar_dieta.php" class="sb-link"><span class="icon">✨</span> Generar dieta</a>
      <a href="listar_dietas.php" class="sb-link"><span class="icon">📋</span> Historial</a>
      <?php if ($_SESSION["rol"] == "admin"): ?>
      <span class="sb-section">Admin</span>
      <a href="listar_usuarios.php" class="sb-link"><span class="icon">👥</span> Usuarios</a>
      <?php endif; ?>
    </nav>
    <div class="sb-footer">
      <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span> Cerrar sesión</a>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title">Menú diario recomendado</div>
        <div class="topbar-subtitle"><?= date("l, j \d\e F") ?></div>
      </div>
    </div>

    <div class="contenido">
      <div class="menu-grid fade-up">

        <div class="meal-card fade-up fade-up-1">
          <div class="meal-header">
            <div class="meal-emoji">☀️</div>
            <div class="meal-header-text">
              <div class="time-label">Mañana · 7–9 AM</div>
              <h3>Desayuno</h3>
            </div>
          </div>
          <div class="meal-body">
            <?php foreach ($desayuno as $d): ?>
            <div class="meal-item">
              <span class="item-name"><?= htmlspecialchars($d["nombre"]) ?></span>
              <span class="kcal-pill"><?= htmlspecialchars($d["calorias"]) ?> kcal</span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="meal-card fade-up fade-up-2">
          <div class="meal-header">
            <div class="meal-emoji">🌤</div>
            <div class="meal-header-text">
              <div class="time-label">Mediodía · 12–2 PM</div>
              <h3>Almuerzo</h3>
            </div>
          </div>
          <div class="meal-body">
            <?php foreach ($almuerzo as $a): ?>
            <div class="meal-item">
              <span class="item-name"><?= htmlspecialchars($a["nombre"]) ?></span>
              <span class="kcal-pill"><?= htmlspecialchars($a["calorias"]) ?> kcal</span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="meal-card fade-up fade-up-3">
          <div class="meal-header">
            <div class="meal-emoji">🌙</div>
            <div class="meal-header-text">
              <div class="time-label">Noche · 7–9 PM</div>
              <h3>Cena</h3>
            </div>
          </div>
          <div class="meal-body">
            <?php foreach ($cena as $c): ?>
            <div class="meal-item">
              <span class="item-name"><?= htmlspecialchars($c["nombre"]) ?></span>
              <span class="kcal-pill"><?= htmlspecialchars($c["calorias"]) ?> kcal</span>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</body>
</html>
