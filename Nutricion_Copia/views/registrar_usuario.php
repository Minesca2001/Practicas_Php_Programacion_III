<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../style.css">
</head>

<style>
    button {
        width: 100%;
        color: white;
        margin-top: 10px;
    }

    body {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        display: flex;
    }
</style>

<body>

    <div class="form-container">

        <h2>Registro de Usuario</h2>

        <form action="../controllers/UsuarioController.php" method="POST">

            <input type="text" name="nombre" placeholder="Nombre" required>

            <input type="email" name="email" placeholder="Email" required>

            <input type="number" step="0.01" name="peso" placeholder="Peso (kg)" required>

            <input type="number" step="0.01" name="altura" placeholder="Altura (m)" required>


            <label>Genero</label>
            <select name="genero" required>
                <option value="">Seleccione</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>


            <label>Nivel de Actividad</label>
            <select name="actividad" required>
                <option value="">Seleccione</option>
                <option value="Sedentario">Sedentario</option>
                <option value="Ligero">Ligero</option>
                <option value="Moderado">Moderado</option>
                <option value="Activo">Activo</option>
            </select>


            <label>Objetivo</label>
            <select name="objetivo" required>
                <option value="">Seleccione</option>
                <option value="Perder">Perder peso</option>
                <option value="Mantener">Mantener peso</option>
                <option value="Ganar">Ganar peso</option>
            </select>

            <button type="submit" name="guardar">Guardar Usuario</button>

        </form>

    </div>

</body>

</html>