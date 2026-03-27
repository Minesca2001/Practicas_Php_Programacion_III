<?php

class Dieta
{

    public function calcularCalorias($peso, $altura, $edad, $genero, $actividad, $objetivo)
    {

        if ($genero == "Masculino") {

            $bmr = 88.36 + (13.4 * $peso) + (4.8 * $altura) - (5.7 * $edad);

        } else {

            $bmr = 447.6 + (9.2 * $peso) + (3.1 * $altura) - (4.3 * $edad);

        }

        switch ($actividad) {

            case "Sedentario":
                $factor = 1.2;
                break;

            case "Ligero":
                $factor = 1.375;
                break;

            case "Moderado":
                $factor = 1.55;
                break;

            case "Intenso":
                $factor = 1.725;
                break;

            default:
                $factor = 1.2;

        }

        $calorias = $bmr * $factor;

        switch ($objetivo) {

            case "Perder":
                $calorias -= 500;
                break;

            case "Ganar":
                $calorias += 500;
                break;

        }

        return round($calorias);

    }

}