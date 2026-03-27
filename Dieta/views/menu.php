<link rel="stylesheet" href="../css/style.css">

<div class="container">

    <h2>Menú Diario Recomendado</h2>

    <h3>Desayuno</h3>

    <ul>

        <?php foreach ($desayuno as $d) { ?>

            <li><?php echo $d["nombre"]; ?> - <?php echo $d["calorias"]; ?> kcal</li>

        <?php } ?>

    </ul>


    <h3>Almuerzo</h3>

    <ul>

        <?php foreach ($almuerzo as $a) { ?>

            <li><?php echo $a["nombre"]; ?> - <?php echo $a["calorias"]; ?> kcal</li>

        <?php } ?>

    </ul>


    <h3>Cena</h3>

    <ul>

        <?php foreach ($cena as $c) { ?>

            <li><?php echo $c["nombre"]; ?> - <?php echo $c["calorias"]; ?> kcal</li>

        <?php } ?>

    </ul>

</div>