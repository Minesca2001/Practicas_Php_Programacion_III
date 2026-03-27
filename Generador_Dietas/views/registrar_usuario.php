<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus,
        select:focus {
            border-color: #4facfe;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-guardar {
            background: #4facfe;
        }

        .btn-guardar:hover {
            background: #2f8ef7;
        }

        .btn-dieta {
            background: #28a745;
        }

        .btn-dieta:hover {
            background: #1f7a33;
        }

        label {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

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

            <button type="submit" name="guardar" class="btn-guardar">
                Guardar Usuario
            </button>

            <button type="submit" name="generar_dieta" class="btn-dieta">
                Generar Dieta
            </button>

        </form>

    </div>

</body>

</html>