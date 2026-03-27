<?php

require_once "../config/conexion.php";

class Usuario
{

    public function guardar($nombre, $email, $password, $rol)
    {

        try {
            global $conexion;

            $sql = "INSERT INTO usuarios (nombre,email,password,rol) VALUES (?,?,?,?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([$nombre, $email, $password, $rol]);

        } catch (PDOException $e) {

            // 🔥 Detectar error de duplicado
            if ($e->getCode() == 23000) {

                session_start();
                $_SESSION["error"] = "El email ya está registrado";

                header("Location: ../views/error.php");
                exit();

            } else {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function listar()
    {

        global $conexion;

        $sql = "SELECT * FROM usuarios";
        $stmt = $conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public function existeEmail($email)
    {
        global $conexion;

        $sql = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch() ? true : false;
    }

}

?>