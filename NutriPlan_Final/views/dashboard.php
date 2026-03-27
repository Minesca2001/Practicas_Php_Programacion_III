<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/components.css">
</head>

<body data-page="dashboard">
  <?php
  require_once "../config/auth.php";
  $h = (int) date("H");
  $sal = $h < 12 ? "¡Buenos días" : ($h < 19 ? "¡Buenas tardes" : "¡Buenas noches");
  ?>
  <div class="page-blobs">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
  </div>
  <div class="layout">
    <?php // setActive("dash");
    require "partials/sidebar.php"; ?>

    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Dashboard</h1>
          <p><?= date("l, j \d\e F \d\e Y") ?></p>
        </div>
        <div class="topbar-right">
          <div class="topbar-pill">
            <div class="online-dot"></div>Sistema activo
          </div>
        </div>
      </div>

      <div class="contenido">
        <div class="welcome-banner fade-up" style="display:flex;align-items:center;justify-content:space-between;">
          <div class="wb-text">
            <h2><?= $sal ?>, <?= htmlspecialchars($_SESSION["nombre"]) ?>!</h2>
            <p style="color:rgba(255,255,255,.75);font-size:14px;margin-top:6px;font-weight:300">Tu plan nutricional te
              espera. ¿Qué haremos hoy?</p>
          </div>
          <div class="wb-emoji">🥗</div>
        </div>

        <div class="stats-row">
          <div class="stat-card c-orange fade-up fade-up-1">
            <span class="sc-icon">🔥</span>
            <div class="sc-val">2,100</div>
            <div class="sc-label">Calorías objetivo</div>
          </div>
          <div class="stat-card c-green fade-up fade-up-2">
            <span class="sc-icon">🥦</span>
            <div class="sc-val">3</div>
            <div class="sc-label">Comidas por día</div>
          </div>
          <div class="stat-card c-yellow fade-up fade-up-3">
            <span class="sc-icon">⚡</span>
            <div class="sc-val">IA</div>
            <div class="sc-label">Plan personalizado</div>
          </div>
          <div class="stat-card c-purple fade-up fade-up-4">
            <span class="sc-icon">📊</span>
            <div class="sc-val">20</div>
            <div class="sc-label">Alimentos registrados</div>
          </div>
        </div>

        <div class="section-title fade-up fade-up-2">
          <span class="accent-line"></span>Acceso rápido
        </div>
        <div class="ql-grid fade-up fade-up-3">
          <a href="generar_dieta.php" class="ql-card">
            <span class="ql-arrow">↗</span>
            <div class="ql-icon orange">✨</div>
            <div>
              <div class="ql-label">Generar nueva dieta</div>
              <div class="ql-sub">Personalizada con IA</div>
            </div>
          </a>
          <a href="listar_dietas.php" class="ql-card">
            <span class="ql-arrow">↗</span>
            <div class="ql-icon green">📋</div>
            <div>
              <div class="ql-label">Historial de dietas</div>
              <div class="ql-sub">Con filtros y exportación</div>
            </div>
          </a>
          <a href="menu.php" class="ql-card">
            <span class="ql-arrow">↗</span>
            <div class="ql-icon yellow">🍽</div>
            <div>
              <div class="ql-label">Menú semanal</div>
              <div class="ql-sub">Plan aleatorio rotativo</div>
            </div>
          </a>
          <a href="alimentos.php" class="ql-card">
            <span class="ql-arrow">↗</span>
            <div class="ql-icon" style="background:rgba(255,209,102,.15)">🥑</div>
            <div>
              <div class="ql-label">Panel de alimentos</div>
              <div class="ql-sub">Guía nutricional completa</div>
            </div>
          </a>
          <?php if ($_SESSION["rol"] == "admin"): ?>
            <a href="listar_usuarios.php" class="ql-card">
              <span class="ql-arrow">↗</span>
              <div class="ql-icon purple">👥</div>
              <div>
                <div class="ql-label">Gestionar usuarios</div>
                <div class="ql-sub">Con filtros y PDF/CSV</div>
              </div>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/app.js"></script>
</body>

</html>