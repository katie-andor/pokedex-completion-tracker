<?php
require_once "config.php";
$pdo = getDBConnection();

if (!empty($_POST["checked_boxes"])) {
    $checked_boxes = $_POST["checked_boxes"];
} else {
    $checked_boxes = [];
}
$total_pokemon = 151;
$total_checked_pokemon = count($checked_boxes);
$percent_completed = number_format(($total_checked_pokemon / $total_pokemon) * 100, 1);

function pokedexResponse ($number) {
    if($number == 0) {?>
        <h1>You haven't caught any Pokémon yet!</h1>
        <h2>Get out there and start your journey!</h2>
        <img src="professor_oak.png"/>
        <?php
    } else if($number < 50){?>
        <h1>Congratulations</h1>
        <h2>on completing <?= $number ?>% of your Pokédex!</h2>
        <h2>Keep going!</h2>
        <img src="surprised_pikachu.jpg"/>
    <?php
    } else if($number == 50){?>
        <h1>Congratulations</h1>
        <h2>on completing <?= $number ?>% of your pokedex!</h2>
        <h2>You're halfway there!</h2>
        <img src="ash_ketchum.jpg"/>
    <?php
    } else if($number > 50 && $number < 100){?>
        <h1>Congratulations</h1>
        <h2>on completing <?= $number ?>% of your pokedex!</h2>
        <h2>You're almost done!</h2>
        <img src="pokemon_cuddling.jpg"/>
    <?php
    } else {?>
        <h1>Congratulations</h1>
        <h2>on completing <?= $number ?>% of your pokedex!</h2>
        <h2>Well done!</h2>
        <img src="full_team.jpg"/>
    <?php
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checked!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="Poké_Ball_icon.svg.png">
</head>
<body class="container text-bg-danger p-3 text-center">
<div class="container text-bg-info p-3 rounded">
<?php
    pokedexResponse($percent_completed);
?>
<br>
<a href="pokemonlist.php"><input type="button" value="Back To The Dex"></a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
