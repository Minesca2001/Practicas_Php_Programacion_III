<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require_once "../config/auth.php";
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 2));
$hora = date("H");
$saludo = $hora < 12 ? "Buenos días" : ($hora < 19 ? "Buenas tardes" : "Buenas noches");
?>
<div class="layout">

  <!-- Sidebar -->
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
      <a href="dashboard.php" class="sb-link active">
        <span class="icon">🏠</span> Inicio
      </a>
      <a href="../controllers/MenuController.php" class="sb-link">
        <span class="icon">🍽</span> Menú del día
      </a>
      <span class="sb-section">Dietas</span>
      <a href="generar_dieta.php" class="sb-link">
        <span class="icon">✨</span> Generar dieta
      </a>
      <a href="listar_dietas.php" class="sb-link">
        <span class="icon">📋</span> Historial
      </a>
      <?php if ($_SESSION["rol"] == "admin"): ?>
      <span class="sb-section">Admin</span>
      <a href="listar_usuarios.php" class="sb-link">
        <span class="icon">👥</span> Usuarios
      </a>
      <?php endif; ?>
    </nav>
    <div class="sb-footer">
      <a href="../controllers/LogoutController.php" class="sb-logout">
        <span>⬅</span> Cerrar sesión
      </a>
    </div>
  </aside>

  <!-- Main -->
  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-title"><?= $saludo ?>, <?= htmlspecialchars($_SESSION["nombre"]) ?> 👋</div>
        <div class="topbar-subtitle"><?= date("l, j \d\e F \d\e Y") ?></div>
      </div>
      <div class="topbar-right">
        <div class="status-dot"></div>
        <span style="font-size:12px;color:var(--text-3)">Sistema activo</span>
      </div>
    </div>

    <div class="contenido">

      <div class="stats-grid fade-up">
        <div class="stat-card fade-up fade-up-1">
          <div class="sc-icon">🥗</div>
          <div class="sc-val">∞</div>
          <div class="sc-lbl">Dietas disponibles</div>
        </div>
        <div class="stat-card fade-up fade-up-2">
          <div class="sc-icon">🔥</div>
          <div class="sc-val">3</div>
          <div class="sc-lbl">Comidas por día</div>
        </div>
        <div class="stat-card fade-up fade-up-3">
          <div class="sc-icon">⚡</div>
          <div class="sc-val">IA</div>
          <div class="sc-lbl">Plan personalizado</div>
        </div>
        <?php if ($_SESSION["rol"] == "admin"): ?>
        <div class="stat-card fade-up fade-up-4">
          <div class="sc-icon">🛡</div>
          <div class="sc-val">ADM</div>
          <div class="sc-lbl">Acceso total</div>
        </div>
        <?php endif; ?>
      </div>

      <div style="margin-bottom:20px" class="fade-up fade-up-2">
        <div class="page-head" style="margin-bottom:16px">
          <h1>Acceso rápido</h1>
          <p>Selecciona una acción para comenzar</p>
        </div>
      </div>

      <div class="ql-grid fade-up fade-up-3">
        <a href="generar_dieta.php" class="ql-card">
          <span class="ql-arr">↗</span>
          <div class="ql-icon">✨</div>
          <div class="ql-title">Generar nueva dieta</div>
        </a>
        <a href="listar_dietas.php" class="ql-card">
          <span class="ql-arr">↗</span>
          <div class="ql-icon">📋</div>
          <div class="ql-title">Ver historial de dietas</div>
        </a>
        <a href="../controllers/MenuController.php" class="ql-card">
          <span class="ql-arr">↗</span>
          <div class="ql-icon">🍽</div>
          <div class="ql-title">Menú diario recomendado</div>
        </a>
        <?php if ($_SESSION["rol"] == "admin"): ?>
        <a href="listar_usuarios.php" class="ql-card">
          <span class="ql-arr">↗</span>
          <div class="ql-icon">👥</div>
          <div class="ql-title">Gestionar usuarios</div>
        </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</div>
</body>
</html>
