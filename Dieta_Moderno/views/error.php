<?php
session_start();

$tipo = $_SESSION["tipo"] ?? "danger";
$mensaje = $_SESSION["error"] ?? "Ha ocurrido un error desconocido.";

unset($_SESSION["error"]);
unset($_SESSION["tipo"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error — NutriPlan</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="error-page">
    <div class="error-card <?= $tipo === 'warning' ? 'is-warning' : 'is-danger' ?>">
        <span class="error-icon"><?= $tipo === 'warning' ? '⚠️' : '❌' ?></span>
        <h3>Algo salió mal</h3>
        <p><?= htmlspecialchars($mensaje) ?></p>
        <a href="login.php" class="btn-back">← Volver al inicio</a>
    </div>
</div>

</body>
</html>
