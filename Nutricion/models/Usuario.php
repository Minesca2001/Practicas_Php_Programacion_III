<?php

require_once "../config/conexion.php";

class Usuario
{
    public function guardar($nombre, $email, $password, $peso, $altura, $genero, $actividad, $objetivo)
    {

        global $conexion;

        // Verificar si el email ya existe
        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {

            echo "Este correo ya está registrado.";
            return;

        }

        // Encriptar contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar usuario
        $sql = "INSERT INTO usuarios
    (nombre,email,password,peso,altura,genero,actividad,objetivo)
    VALUES (?,?,?,?,?,?,?,?)";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            $nombre,
            $email,
            $passwordHash,
            $peso,
            $altura,
            $genero,
            $actividad,
            $objetivo
        ]);
    }
    public function listar()
    {

        global $conexion;

        $sql = "SELECT * FROM usuarios";

        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
}

?>