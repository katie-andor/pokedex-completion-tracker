<?php
require_once "config.php";
$pdo = getDBConnection();
$sql = "Select * from fun_facts
        ORDER BY Rand()
        LIMIT 10";
if($stmt = $pdo->prepare($sql)){
    if($stmt->execute()){
        $rows = $stmt->fetchAll();
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
    <title>Fun Facts</title>
    <link rel="icon" type="image/x-icon" href="Poké_Ball_icon.svg.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="text-bg-danger p-3 text-center">
<div class="p-3 mb-2 bg-light text-dark rounded border border-dark">
    <h1>Gen 1 Fun Facts!</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="submit" value="Press for More Facts">
    </form>

    <?php
        foreach ($rows as $row){?>
            <h4><?= $row['fact_title'] ?></h4>
            <p><?= $row['fact_text'] ?></p>
        <?php
        }
    ?>
    <a href="pokemonlist.php"><input type="button" value="Back To The Dex"></a>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>