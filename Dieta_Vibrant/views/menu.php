<?php
require_once "../config/auth.php";
include_once "../controllers/MenuController.php";
$ini = strtoupper(substr($_SESSION["nombre"], 0, 2)); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú del Día — NutriPlan</title>
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
        <a href="../views/dashboard.php" class="sb-link"><span class="sb-icon">🏠</span>Inicio</a>
        <a href="../controllers/MenuController.php" class="sb-link active"><span class="sb-icon">🍽</span>Menú del
          día</a>
        <span class="sb-group-label">Mis dietas</span>
        <a href="../views/generar_dieta.php" class="sb-link"><span class="sb-icon">✨</span>Generar dieta</a>
        <a href="../views/listar_dietas.php" class="sb-link"><span class="sb-icon">📋</span>Historial</a>
        <?php if ($_SESSION["rol"] == "admin"): ?>
          <span class="sb-group-label">Administración</span>
          <a href="../views/listar_usuarios.php" class="sb-link"><span class="sb-icon">👥</span>Usuarios</a>
        <?php endif; ?>
      </nav>
      <div class="sb-footer">
        <a href="../controllers/LogoutController.php" class="sb-logout"><span>⬅</span>Cerrar sesión</a>
      </div>
    </aside>

    <div class="main-area">
      <div class="topbar">
        <div class="topbar-left">
          <h1>Menú del día 🍽</h1>
          <p><?= date("l, j \d\e F \d\e Y") ?></p>
        </div>
      </div>

      <div class="contenido">

        <!-- Resumen total calorías -->
        <?php
        $total = 0;
        foreach (array_merge($desayuno, $almuerzo, $cena) as $item)
          $total += (int) $item["calorias"];
        ?>
        <div class="menu-summary fade-up">
          <div>
            <div class="menu-total"><?= number_format($total) ?> kcal</div>
            <div class="menu-total-label">Total del día</div>
          </div>
          <div class="menu-divider"></div>
          <div>
            <div style="font-weight:700;color:var(--ink)">
              <?= count($desayuno) + count($almuerzo) + count($cena) ?> alimentos
            </div>
            <div class="menu-total-label">En 3 comidas</div>
          </div>
          <div class="menu-divider"></div>
          <div>
            <div style="font-weight:700;color:var(--green-dk)">Balanceado</div>
            <div class="menu-total-label">Plan del día</div>
          </div>
        </div>

        <div class="menu-grid fade-up fade-up-1">

          <!-- Desayuno -->
          <div class="meal-card">
            <div class="meal-header dawn">
              <div class="meal-icon-wrap dawn">☀️</div>
              <div class="meal-header-info">
                <div class="time dawn">Mañana · 7–9 AM</div>
                <h3>Desayuno</h3>
              </div>
            </div>
            <div class="meal-body">
              <?php foreach ($desayuno as $d): ?>
                <div class="meal-item">
                  <span><?= htmlspecialchars($d["nombre"]) ?></span>
                  <span class="kcal-pill dawn"><?= htmlspecialchars($d["calorias"]) ?> kcal</span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Almuerzo -->
          <div class="meal-card">
            <div class="meal-header noon">
              <div class="meal-icon-wrap noon">🌤</div>
              <div class="meal-header-info">
                <div class="time noon">Mediodía · 12–2 PM</div>
                <h3>Almuerzo</h3>
              </div>
            </div>
            <div class="meal-body">
              <?php foreach ($almuerzo as $a): ?>
                <div class="meal-item">
                  <span><?= htmlspecialchars($a["nombre"]) ?></span>
                  <span class="kcal-pill noon"><?= htmlspecialchars($a["calorias"]) ?> kcal</span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Cena -->
          <div class="meal-card">
            <div class="meal-header night">
              <div class="meal-icon-wrap night">🌙</div>
              <div class="meal-header-info">
                <div class="time night">Noche · 7–9 PM</div>
                <h3>Cena</h3>
              </div>
            </div>
            <div class="meal-body">
              <?php foreach ($cena as $c): ?>
                <div class="meal-item">
                  <span><?= htmlspecialchars($c["nombre"]) ?></span>
                  <span class="kcal-pill night"><?= htmlspecialchars($c["calorias"]) ?> kcal</span>
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