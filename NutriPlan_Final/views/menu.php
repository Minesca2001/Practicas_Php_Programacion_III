<?php require_once "../config/auth.php";
$ini = strtoupper(substr($_SESSION["nombre"],0,2)); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Semanal — NutriPlan</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/components.css">
</head>
<body data-page="menu">
<div class="page-blobs"><div class="blob blob-1"></div><div class="blob blob-2"></div></div>
<div class="layout">
  <?php require_once "partials/sidebar.php"; setActive("menu"); ?>
  <div class="main-area">
    <div class="topbar">
      <div class="topbar-left">
        <h1>Menú semanal 🍽</h1>
        <p>Plan aleatorio rotativo — semana <?= date("W") ?></p>
      </div>
      <div class="topbar-right">
        <div class="topbar-pill"><div class="online-dot"></div>Carga en vivo</div>
      </div>
    </div>
    <div class="contenido">
      <div id="menu-semana-grid" class="menu-semana-grid">
        <div class="loading-state"><span class="spin big">⟳</span><p>Cargando menú semanal…</p></div>
      </div>
    </div>
  </div>
</div>
<script src="../js/app.js"></script>
</body>
</html>
