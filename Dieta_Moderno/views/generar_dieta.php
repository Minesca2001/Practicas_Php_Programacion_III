<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Dieta — NutriPlan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require_once "../config/auth.php"; ?>

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
            <h1>Generar dieta personalizada</h1>
            <p>Ingresa tus datos para calcular tu plan nutricional óptimo.</p>
        </div>

        <div class="form-card">
            <h2>Datos personales</h2>
            <p class="form-sub">Tu información física nos ayuda a calcular tus necesidades calóricas.</p>

            <form action="../controllers/GenerarDietaController.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="peso">Peso (kg)</label>
                        <input type="number" id="peso" name="peso" placeholder="Ej. 70" required>
                    </div>
                    <div class="form-group">
                        <label for="altura">Altura (m)</label>
                        <input type="number" id="altura" name="altura" step="any" placeholder="Ej. 1.75" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="edad">Edad</label>
                        <input type="number" id="edad" name="edad" placeholder="Ej. 28" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Género</label>
                        <select id="genero" name="genero">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                </div>

                <p class="form-section-title">Estilo de vida y objetivo</p>

                <div class="form-group">
                    <label for="actividad">Nivel de actividad física</label>
                    <select id="actividad" name="actividad">
                        <option value="Sedentario">Sedentario — Poco o ningún ejercicio</option>
                        <option value="Ligero">Ligero — Ejercicio 1–3 días/semana</option>
                        <option value="Moderado">Moderado — Ejercicio 3–5 días/semana</option>
                        <option value="Intenso">Intenso — Ejercicio 6–7 días/semana</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="objetivo">Objetivo</label>
                    <select id="objetivo" name="objetivo">
                        <option value="Perder">🔥 Perder peso</option>
                        <option value="Mantener">⚖️ Mantener peso</option>
                        <option value="Ganar">💪 Ganar masa muscular</option>
                    </select>
                </div>

                <button type="submit">Calcular mi dieta personalizada</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>
