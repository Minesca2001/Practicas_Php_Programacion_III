<?php
require_once "../config/auth.php";
require_once "../config/conexion.php";
if (!isset($_SESSION["usuario_id"])) {
  header("Location: login.php");
  exit();
}
$stmt = $conexion->prepare("SELECT * FROM dietas WHERE usuario_id = ? ORDER BY fecha DESC");
$stmt->execute([$_SESSION["usuario_id"]]);
$dietas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$ini = strtoupper(substr($_SESSION["nombre"], 0, 2));

$obj_badges = [
  'Perder' => ['class' => 'badge-orange', 'icon' => '🔥'],
  'Mantener' => ['class' => 'badge-green', 'icon' => '⚖️'],
  'Ganar' => ['class' => 'badge-purple', 'icon' => '💪'],
];
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
        <a href="listar_dietas.php" class="sb-link active"><span class="sb-icon">📋</span>Historial</a>
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
          <h1>Historial de dietas</h1>
          <p>Todos tus planes nutricionales generados</p>
        </div>
        <div class="topbar-right">
          <a href="generar_dieta.php" class="btn-sm">✨ Nueva dieta</a>
        </div>
      </div>

      <div class="contenido fade-up">
        <div class="table-wrap">
          <div class="table-top">
            <h2>Mis planes nutricionales</h2>
            <span class="table-count"><?= count($dietas) ?> registros</span>
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
                <th>Descripción del plan</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($dietas) > 0): ?>
                <?php foreach ($dietas as $d):
                  $obj = $d["objetivo"] ?? "Mantener";
                  $b = $obj_badges[$obj] ?? ['class' => 'badge-green', 'icon' => '✅'];
                  ?>
                  <tr>
                    <td class="td-muted"><?= htmlspecialchars($d["fecha"]) ?></td>
                    <td><?= htmlspecialchars($d["peso"]) ?> <span class="td-muted">kg</span></td>
                    <td><?= htmlspecialchars($d["altura"]) ?> <span class="td-muted">m</span></td>
                    <td><strong><?= round($d["imc"], 2) ?></strong></td>
                    <td><span class="td-strong"><?= round($d["calorias"]) ?></span> <span class="td-muted">kcal</span></td>
                    <td><span class="badge <?= $b['class'] ?>"><?= $b['icon'] ?>     <?= htmlspecialchars($obj) ?></span></td>
                    <td class="cell-desc"><?= nl2br(htmlspecialchars($d["descripcion"])) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7">
                    <div class="empty-state">
                      <span class="empty-emoji">🥗</span>
                      <p>Aún no tienes dietas generadas. <a href="generar_dieta.php">¡Crear mi primera dieta!</a></p>
                    </div>
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