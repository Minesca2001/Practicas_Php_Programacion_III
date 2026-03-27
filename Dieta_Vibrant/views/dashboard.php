<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <?php
  require_once "../config/auth.php";
  $ini = strtoupper(substr($_SESSION["nombre"], 0, 2));
  $h = (int) date("H");
  $sal = $h < 12 ? "¡Buenos días" : ($h < 19 ? "¡Buenas tardes" : "¡Buenas noches");
  ?>
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
        <a href="dashboard.php" class="sb-link active"><span class="sb-icon">🏠</span>Inicio</a>
        <a href="../controllers/MenuController.php" class="sb-link"><span class="sb-icon">🍽</span>Menú del día</a>
        <span class="sb-group-label">Mis dietas</span>
        <a href="generar_dieta.php" class="sb-link"><span class="sb-icon">✨</span>Generar dieta</a>
        <a href="listar_dietas.php" class="sb-link"><span class="sb-icon">📋</span>Historial</a>
        <?php if ($_SESSION["rol"] == "admin"): ?>
          <span class="sb-group-label">Administración</span>
          <a href="listar_usuarios.php" class="sb-link"><span class="sb-icon">👥</span>Usuarios</a>
        <?php endif; ?>
      </nav>
      <div class="sb-footer">
        <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span>Cerrar sesión</a>
      </div>
    </aside>

    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Dashboard</h1>
          <p><?= date("l, j \d\e F \d\e Y") ?></p>
        </div>
        <div class="topbar-right">
          <div class="topbar-pill">
            <div class="online-dot"></div>
            Sistema activo
          </div>
        </div>
      </div>

      <div class="contenido">

        <!-- Banner de bienvenida -->
        <div class="welcome-banner fade-up" style="display:flex;align-items:center;justify-content:space-between;">
          <div class="wb-text">
            <h2><?= $sal ?>, <?= htmlspecialchars($_SESSION["nombre"]) ?>!</h2>
            <p style="color:rgba(255,255,255,0.75);font-size:14px;margin-top:6px;font-weight:300">Tu plan nutricional te
              espera. ¿Qué haremos hoy?</p>
          </div>
          <div class="wb-emoji">🥗</div>
        </div>

        <!-- Stats -->
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
            <span class="sc-icon">⚖️</span>
            <div class="sc-val">IMC</div>
            <div class="sc-label">Calcula tu índice hoy</div>
          </div>
          <?php if ($_SESSION["rol"] == "admin"): ?>
            <div class="stat-card c-purple fade-up fade-up-4">
              <span class="sc-icon">🛡</span>
              <div class="sc-val">ADM</div>
              <div class="sc-label">Acceso administrador</div>
            </div>
          <?php else: ?>
            <div class="stat-card c-purple fade-up fade-up-4">
              <span class="sc-icon">✨</span>
              <div class="sc-val">IA</div>
              <div class="sc-label">Plan personalizado</div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Quick links -->
        <div class="section-title fade-up fade-up-2">
          <span class="accent-line"></span>
          Acceso rápido
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
              <div class="ql-sub">Todos tus planes anteriores</div>
            </div>
          </a>
          <a href="../controllers/MenuController.php" class="ql-card">
            <span class="ql-arrow">↗</span>
            <div class="ql-icon yellow">🍽</div>
            <div>
              <div class="ql-label">Menú del día</div>
              <div class="ql-sub">Alimentos recomendados hoy</div>
            </div>
          </a>
          <?php if ($_SESSION["rol"] == "admin"): ?>
            <a href="listar_usuarios.php" class="ql-card">
              <span class="ql-arrow">↗</span>
              <div class="ql-icon purple">👥</div>
              <div>
                <div class="ql-label">Gestionar usuarios</div>
                <div class="ql-sub">Panel de administración</div>
              </div>
            </a>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
</body>

</html>