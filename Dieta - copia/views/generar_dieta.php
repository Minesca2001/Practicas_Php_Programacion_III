<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">

    <h2>Generador de Dieta</h2>

    <form action="../controllers/GenerarDietaController.php" method="POST">

        <div class="row">

            <div class="col-md-4">
                <input type="number" name="peso" class="form-control mb-3" placeholder="Peso">
            </div>

            <div class="col-md-4">
                <input type="number" name="altura" class="form-control mb-3" placeholder="Altura">
            </div>

            <div class="col-md-4">
                <input type="number" name="edad" class="form-control mb-3" placeholder="Edad">
            </div>

        </div>

        <select name="genero" class="form-control mb-3">
            <option>Masculino</option>
            <option>Femenino</option>
        </select>

        <select name="actividad" class="form-control mb-3">
            <option>Sedentario</option>
            <option>Moderado</option>
            <option>Intenso</option>
        </select>

        <select name="objetivo" class="form-control mb-3">
            <option>Perder</option>
            <option>Mantener</option>
            <option>Ganar</option>
        </select>

        <button class="btn btn-success">Generar</button>

    </form>

</div>