<!-- <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Aplicación PHP</title>

    <link rel="stylesheet" href="css/estilos_base.css">

    <?php
    $seccion = $_GET['p'] ?? 'home';
    if (file_exists("css/{$seccion}.css")) {
        echo "<link rel='stylesheet' href='css/{$seccion}.css'>";
    }
    ?>
</head>

<body>

    <nav>
        <a href="?p=home">Inicio</a>
        <a href="?p=ventas">Ventas</a>
    </nav>

    <main>
        <?php
        // 3. Inyectamos el contenido de la sección
        $archivo = "paginas/{$seccion}.php";
        if (file_exists($archivo)) {
            include $archivo;
        } else {
            echo "<h2>404 - Página no encontrada</h2>";
        }
        ?>
    </main>

    <script src="js/main.js"></script>

    <?php if ($seccion === 'ventas'): ?>
        <script src="js/graficos_ventas.js"></script>
    <?php endif; ?>

</body>

</html> -->
<?php

header("Location: views/registrar_usuario.php");

?>