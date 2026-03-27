<?php require_once "../config/auth.php"; ?>
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
            <h1>Menú diario recomendado</h1>
            <p>Alimentos sugeridos para hoy según tu perfil nutricional.</p>
        </div>

        <div class="menu-grid">

            <!-- Desayuno -->
            <div class="meal-card">
                <div class="meal-time">☀️ Mañana</div>
                <h3>Desayuno</h3>
                <ul>
                    <?php foreach ($desayuno as $d): ?>
                    <li class="meal-item">
                        <?= htmlspecialchars($d["nombre"]) ?>
                        <span class="kcal-pill"><?= htmlspecialchars($d["calorias"]) ?> kcal</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Almuerzo -->
            <div class="meal-card">
                <div class="meal-time">🌤 Mediodía</div>
                <h3>Almuerzo</h3>
                <ul>
                    <?php foreach ($almuerzo as $a): ?>
                    <li class="meal-item">
                        <?= htmlspecialchars($a["nombre"]) ?>
                        <span class="kcal-pill"><?= htmlspecialchars($a["calorias"]) ?> kcal</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Cena -->
            <div class="meal-card">
                <div class="meal-time">🌙 Noche</div>
                <h3>Cena</h3>
                <ul>
                    <?php foreach ($cena as $c): ?>
                    <li class="meal-item">
                        <?= htmlspecialchars($c["nombre"]) ?>
                        <span class="kcal-pill"><?= htmlspecialchars($c["calorias"]) ?> kcal</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>

</div>
</body>
</html>
