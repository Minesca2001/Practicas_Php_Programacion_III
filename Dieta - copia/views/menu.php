<?php
session_start();

if (!isset($_SESSION["menu"])) {
    echo "<div class='alert alert-danger text-center mt-5'>No hay menú generado</div>";
    exit();
}

$menu = $_SESSION["menu"];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <h2 class="text-center mb-4">Menú Diario</h2>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow p-3 mb-3">
                <h5>🥣 Desayuno</h5>
                <p><?php echo $menu["desayuno"] ?? "No disponible"; ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 mb-3">
                <h5>🍎 Media Mañana</h5>
                <p><?php echo $menu["media_manana"] ?? "No disponible"; ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 mb-3">
                <h5>🍛 Almuerzo</h5>
                <p><?php echo $menu["almuerzo"] ?? "No disponible"; ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 mb-3">
                <h5>☕ Merienda</h5>
                <p><?php echo $menu["merienda"] ?? "No disponible"; ?></p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow p-3 mb-3">
                <h5>🍽️ Cena</h5>
                <p><?php echo $menu["cena"] ?? "No disponible"; ?></p>
            </div>
        </div>

    </div>

</div>