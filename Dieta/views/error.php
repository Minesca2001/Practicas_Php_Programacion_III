<?php
$tipo = $_SESSION["tipo"] ?? "danger";

session_start();

$mensaje = $_SESSION["error"] ?? "Error desconocido";

// limpiar después de usar
unset($_SESSION["error"]);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">

    <div class="card shadow p-4 text-center" style="width:400px;">

        <h3 class="text-<?php echo $tipo; ?>">⚠ Error</h3>

        <p>
            <?php echo $mensaje; ?>
        </p>

        <a href="login.php" class="btn btn-primary mt-3">Volver</a>

    </div>

</body>

</html>
<