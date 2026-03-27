<?php
session_start();
require_once "../config/conexion.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];
$sql = "SELECT * FROM dietas WHERE usuario_id = ? ORDER BY fecha DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute([$usuario_id]);
$dietas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Dietas — NutriPlan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="layout">

    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-name">NutriPlan</div>
            <div class="brand-sub">Sistema de Nutrición</div>
        </div>
        <div class="sidebar-user">
            <div class="user-name"><?php echo htmlspecialchars($_SESSION["nombre"]); ?></div>
            <div class="user-tag"><?php echo htmlspecialchars($_SESSION["rol"]); ?></div>
        </div>
        <nav class="sidebar-nav">
            <span class="nav-label">Principal</span>
            <a href="dashboard.php">🏠 Inicio</a>
            <a href="../controllers/MenuController.php">🍽 Menú diario</a>
            <span class="nav-label">Dietas</span>
            <a href="generar_dieta.php">✨ Generar dieta</a>
            <a href="listar_dietas.php">📋 Historial</a>
            <?php if ($_SESSION["rol"] == "admin"): ?>
            <span class="nav-label">Administración</span>
            <a href="listar_usuarios.php">👥 Usuarios</a>
            <?php endif; ?>
        </nav>
        <div class="sidebar-footer">
            <a href="../controllers/LogoutController.php">⬅ Cerrar sesión</a>
        </div>
    </div>

    <div class="contenido">
        <div class="page-header">
            <h1>Historial de dietas</h1>
            <p>Registro de todos tus planes nutricionales generados.</p>
        </div>

        <div class="table-wrapper">
            <div class="table-header">
                <h2>Mis dietas</h2>
                <span class="table-count"><?= count($dietas) ?> registros</span>
            </div>

            <?php if (count($dietas) > 0): ?>
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
                    <?php foreach ($dietas as $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d["fecha"]) ?></td>
                        <td><?= htmlspecialchars($d["peso"]) ?> kg</td>
                        <td><?= htmlspecialchars($d["altura"]) ?> m</td>
                        <td><?= round($d["imc"], 2) ?></td>
                        <td><?= round($d["calorias"]) ?> kcal</td>
                        <td><span class="badge badge-green"><?= htmlspecialchars($d["objetivo"]) ?></span></td>
                        <td><?= nl2br(htmlspecialchars($d["descripcion"])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="empty-state">
                <span class="empty-icon">🥗</span>
                <p>Aún no has generado ninguna dieta. <a href="generar_dieta.php">Crear mi primera dieta</a></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
</body>
</html>
