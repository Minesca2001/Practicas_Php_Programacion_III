<link rel="stylesheet" href="../css/style.css">
<div class="container">
    <form action="../controllers/GenerarDietaController.php" method="POST">

        <h2>Generador de Dieta</h2>

        <input type="number" name="peso" placeholder="Peso (kg)">

        <input type="number" step="any" name="altura" placeholder="Altura (m)">

        <input type="number" name="edad" placeholder="Edad">

        <select name="genero">

            <option>Masculino</option>
            <option>Femenino</option>
            <option>Prefiero no decirlo</option>
            <option>Otro</option>

        </select>

        <select name="actividad">

            <option>Sedentario</option>
            <option>Ligero</option>
            <option>Moderado</option>
            <option>Intenso</option>

        </select>

        <select name="objetivo">

            <option>Perder</option>
            <option>Mantener</option>
            <option>Ganar</option>

        </select>

        <button type="submit">Generar Dieta</button>

    </form>
</div>