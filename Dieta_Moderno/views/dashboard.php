<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — NutriPlan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require_once "../config/auth.php"; ?>

<div class="layout">

    <!-- Sidebar -->
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

    <!-- Contenido principal -->
    <div class="contenido">
        <div class="page-header">
            <h1>Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?> 👋</h1>
            <p>Bienvenido a tu panel de nutrición personalizada.</p>
        </div>

        <div class="quick-links">
            <a href="generar_dieta.php" class="quick-link-card">
                <div class="ql-icon">✨</div>
                <div class="ql-title">Generar nueva dieta</div>
            </a>
            <a href="listar_dietas.php" class="quick-link-card">
                <div class="ql-icon">📋</div>
                <div class="ql-title">Ver historial de dietas</div>
            </a>
            <a href="../controllers/MenuController.php" class="quick-link-card">
                <div class="ql-icon">🍽</div>
                <div class="ql-title">Menú diario recomendado</div>
            </a>
            <?php if ($_SESSION["rol"] == "admin"): ?>
            <a href="listar_usuarios.php" class="quick-link-card">
                <div class="ql-icon">👥</div>
                <div class="ql-title">Gestionar usuarios</div>
            </a>
            <?php endif; ?>
        </div>
    </div>

</div>
</body>
</html>
