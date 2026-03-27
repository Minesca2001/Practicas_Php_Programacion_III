<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

$alimentos = [
  ["id" => 1, "nombre" => "Avena integral", "emoji" => "🌾", "categoria" => "Cereales", "calorias" => 389, "proteinas" => 17, "carbos" => 66, "grasas" => 7, "descripcion" => "Rica en fibra soluble beta-glucano, ideal para el desayuno y control glucémico."],
  ["id" => 2, "nombre" => "Pechuga de pollo", "emoji" => "🍗", "categoria" => "Proteínas", "calorias" => 165, "proteinas" => 31, "carbos" => 0, "grasas" => 4, "descripcion" => "Fuente magra de proteína completa, perfecta para ganar o mantener masa muscular."],
  ["id" => 3, "nombre" => "Salmón atlántico", "emoji" => "🐟", "categoria" => "Proteínas", "calorias" => 208, "proteinas" => 20, "carbos" => 0, "grasas" => 13, "descripcion" => "Alto en omega-3 y vitamina D, excelente para la salud cardiovascular."],
  ["id" => 4, "nombre" => "Brócoli", "emoji" => "🥦", "categoria" => "Vegetales", "calorias" => 34, "proteinas" => 3, "carbos" => 7, "grasas" => 0, "descripcion" => "Súpervegetal con vitamina C, K y sulforafano, potente antioxidante."],
  ["id" => 5, "nombre" => "Arroz integral", "emoji" => "🍚", "categoria" => "Cereales", "calorias" => 216, "proteinas" => 5, "carbos" => 45, "grasas" => 2, "descripcion" => "Carbohidrato complejo de liberación lenta, mantiene energía estable."],
  ["id" => 6, "nombre" => "Aguacate", "emoji" => "🥑", "categoria" => "Grasas buenas", "calorias" => 160, "proteinas" => 2, "carbos" => 9, "grasas" => 15, "descripcion" => "Grasas monoinsaturadas saludables, potasio y ácido fólico."],
  ["id" => 7, "nombre" => "Huevo entero", "emoji" => "🥚", "categoria" => "Proteínas", "calorias" => 155, "proteinas" => 13, "carbos" => 1, "grasas" => 11, "descripcion" => "Proteína de alta calidad biológica con todos los aminoácidos esenciales."],
  ["id" => 8, "nombre" => "Plátano", "emoji" => "🍌", "categoria" => "Frutas", "calorias" => 89, "proteinas" => 1, "carbos" => 23, "grasas" => 0, "descripcion" => "Fuente de potasio y carbohidratos rápidos, ideal pre-entrenamiento."],
  ["id" => 9, "nombre" => "Espinaca", "emoji" => "🌿", "categoria" => "Vegetales", "calorias" => 23, "proteinas" => 3, "carbos" => 4, "grasas" => 0, "descripcion" => "Rica en hierro, magnesio y vitaminas del grupo B. Versátil y nutritiva."],
  ["id" => 10, "nombre" => "Lentejas", "emoji" => "🫘", "categoria" => "Legumbres", "calorias" => 116, "proteinas" => 9, "carbos" => 20, "grasas" => 0, "descripcion" => "Excelente fuente de proteína vegetal y hierro, alta en fibra."],
  ["id" => 11, "nombre" => "Yogur griego", "emoji" => "🫙", "categoria" => "Lácteos", "calorias" => 97, "proteinas" => 10, "carbos" => 4, "grasas" => 5, "descripcion" => "Probióticos naturales para la microbiota intestinal y proteína caseinada."],
  ["id" => 12, "nombre" => "Almendras", "emoji" => "🌰", "categoria" => "Frutos secos", "calorias" => 579, "proteinas" => 21, "carbos" => 22, "grasas" => 50, "descripcion" => "Vitamina E, magnesio y grasas saludables. Ideal como snack nutritivo."],
  ["id" => 13, "nombre" => "Batata / Camote", "emoji" => "🍠", "categoria" => "Tubérculos", "calorias" => 86, "proteinas" => 2, "carbos" => 20, "grasas" => 0, "descripcion" => "Betacaroteno, vitamina C y carbohidratos de absorción media."],
  ["id" => 14, "nombre" => "Atún en agua", "emoji" => "🐠", "categoria" => "Proteínas", "calorias" => 116, "proteinas" => 26, "carbos" => 0, "grasas" => 1, "descripcion" => "Proteína ultra magra, práctica y económica. Alto en selenio."],
  ["id" => 15, "nombre" => "Fresas", "emoji" => "🍓", "categoria" => "Frutas", "calorias" => 32, "proteinas" => 1, "carbos" => 8, "grasas" => 0, "descripcion" => "Antioxidantes, vitamina C y bajo índice glucémico. Perfectas para dieta."],
  ["id" => 16, "nombre" => "Quinoa", "emoji" => "🌾", "categoria" => "Cereales", "calorias" => 222, "proteinas" => 8, "carbos" => 39, "grasas" => 4, "descripcion" => "Pseudocereal con proteína completa, libre de gluten y muy nutritivo."],
  ["id" => 17, "nombre" => "Tomate cherry", "emoji" => "🍅", "categoria" => "Vegetales", "calorias" => 18, "proteinas" => 1, "carbos" => 4, "grasas" => 0, "descripcion" => "Licopeno antioxidante, vitamina C y K. Bajo en calorías."],
  ["id" => 18, "nombre" => "Pavo en filete", "emoji" => "🦃", "categoria" => "Proteínas", "calorias" => 135, "proteinas" => 30, "carbos" => 0, "grasas" => 1, "descripcion" => "La carne más magra disponible, alta en triptófano precursor de serotonina."],
  ["id" => 19, "nombre" => "Leche descremada", "emoji" => "🥛", "categoria" => "Lácteos", "calorias" => 35, "proteinas" => 3, "carbos" => 5, "grasas" => 0, "descripcion" => "Calcio biodisponible y vitamina D para huesos y sistema nervioso."],
  ["id" => 20, "nombre" => "Manzana verde", "emoji" => "🍏", "categoria" => "Frutas", "calorias" => 52, "proteinas" => 0, "carbos" => 14, "grasas" => 0, "descripcion" => "Pectina prebiótica, quercetina antioxidante y bajo aporte calórico."],
];


echo json_encode($alimentos, JSON_UNESCAPED_UNICODE);
