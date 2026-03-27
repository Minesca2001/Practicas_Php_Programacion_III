<?php
session_start();
require_once "../config/conexion.php";
if (!isset($_SESSION["usuario_id"])) { header("Location: login.php"); exit(); }
$usuario_id = $_SESSION["usuario_id"];
$stmt = $conexion->prepare("SELECT * FROM dietas WHERE usuario_id = ? ORDER BY fecha DESC");
$stmt->execute([$usuario_id]);
$dietas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$inicial = strtoupper(substr($_SESSION["nombre"], 0, 2));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial — NutriPlan</title>
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
      <a href="listar_dietas.php" class="sb-link active"><span class="icon">📋</span> Historial</a>
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
        <div class="topbar-title">Historial de dietas</div>
        <div class="topbar-subtitle">Todos tus planes nutricionales generados</div>
      </div>
      <div class="topbar-right">
        <a href="generar_dieta.php" class="btn btn-primary" style="width:auto;padding:9px 18px;font-size:13px;margin-top:0">+ Nueva dieta</a>
      </div>
    </div>

    <div class="contenido fade-up">
      <div class="tbl-wrap">
        <div class="tbl-head">
          <h2>Mis dietas</h2>
          <span class="tbl-count"><?= count($dietas) ?> registros</span>
        </div>

        <table>
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Peso</th>
              <th>Altura</th>
              <th>IMC</th>
              <th>Calorías</th>
              <th>Objetivo</th>
              <th>Descripción</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($dietas) > 0): ?>
              <?php foreach ($dietas as $d): ?>
              <tr>
                <td><?= htmlspecialchars($d["fecha"]) ?></td>
                <td><?= htmlspecialchars($d["peso"]) ?> kg</td>
                <td><?= htmlspecialchars($d["altura"]) ?> m</td>
                <td><?= round($d["imc"], 2) ?></td>
                <td><strong style="color:var(--emerald)"><?= round($d["calorias"]) ?></strong> kcal</td>
                <td><span class="badge badge-green"><?= htmlspecialchars($d["objetivo"]) ?></span></td>
                <td class="cell-desc"><?= nl2br(htmlspecialchars($d["descripcion"])) ?></td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr class="empty-row">
                <td colspan="7">
                  <span class="empty-icon">🥗</span>
                  Aún no tienes dietas. <a href="generar_dieta.php" style="color:var(--emerald)">Crear mi primera dieta</a>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
