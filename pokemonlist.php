<?php
require_once "config.php";
$pdo = getDBConnection();

$search = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM pokemon_data WHERE name LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%');
} else {
    $sql = "SELECT * FROM pokemon_data";
    $stmt = $pdo->prepare($sql);
}

if ($stmt->execute()) {
    $rows = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gen 1 Pokedex Tracker</title>
    <link rel="icon" type="image/x-icon" href="Poké_Ball_icon.svg.png">
</head>
<body class="container text-bg-danger p-3">
<div class="text-center">
    <h1> Gen 1 Pokedex Tracker</h1>
    <p>Check off the Pokemon you've caught, hit submit, and see your progress percentage!</p>
    <h2>Also check out the <a class="link-info" href="random_fun_facts.php" >Gen 1 Fun Facts</a> section!</h2>

    <form method="get" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search Pokémon by name" value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-info">Search</button>
        </div>
    </form>

    <form action="pokedex_completion_calculator.php" method="post">
        <table class="table table-info table table-striped text-center">
            <tr>
                <th>Number</th>
                <th>Name</th>
                <th>Primary Typing</th>
                <th>Secondary Typing</th>
                <th>Height (m)</th>
                <th>Weight (kg)</th>
                <th>Male Percentage</th>
                <th>Female Percentage</th>
                <th>Capture Rate</th>
            </tr>
            <?php
                foreach ($rows as $row){
            ?>
                <tr>
                    <td><?= $row['number'] ?></td>
                    <td>
                        <?= $row['name'] ?>
                        <input type="checkbox" name="checked_boxes[<?= $row["number"] ?>]" value="<?= $row["name"] ?>">
                    </td>
                    <td class="text-capitalize"><?= $row['type1'] ?></td>
                    <td class="text-capitalize"><?= $row['type2'] ?></td>
                    <td><?= $row['height'] ?></td>
                    <td><?= $row['weight'] ?></td>
                    <td><?= $row['male_percentage'] ?>%</td>
                    <td><?= $row['female_percentage'] ?>%</td>
                    <td><?= $row['capture_rate'] ?></td>
                </tr>
            <?php
                }
            ?>
        </table>
        <input type="submit" value="Check Progress" >
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');

        checkboxes.forEach(checkbox => {
            const savedState = localStorage.getItem(checkbox.value);
            if (savedState === 'true') {
                checkbox.checked = true;
            }
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                localStorage.setItem(checkbox.value, checkbox.checked);
            });
        });
    });
</script>
</body>
</html>