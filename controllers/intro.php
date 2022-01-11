<?php

if (!isset($_GET["name"])) {
    $name = "Seb";
} else {
    $name = $_GET["name"];
}
$color = $_GET["color"] ?? "red";
$backgroundColor = "#CCAACC";

$age = "vous avez 50 ans et 3 mois";

$gender = "male";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Première page PHP</title>
    <style>
        body {
            background-color: <?php echo $backgroundColor ?>
        }
    </style>
</head>
<body>
    <h1 style="color: <?php echo $color ?>">
        Bonjour <?php echo $name ?> nous sommes le
        <?php echo date("d/m/Y"); ?>
    </h1>

    <?php
echo "<h2>Bonjour $name </h2>";
var_dump($backgroundColor);

var_dump($age);
var_dump((int) $age);

echo ($gender);
?>

    <pre>
        <?php print_r($_SERVER);?>
    <pre>
<table>
    <?php
for ($i = 1; $i <= 10; $i++) {
    if ($i % 2) {
        echo '<tr style="background-color:#CCC;">';
    } else {
        echo '<tr>';
    }
    for ($k = 1; $k <= 10; $k++) {
        if ($k % 2 == 0) {
            echo '<td style="background-color:#888;">' . $i * $k . '</td>';
        } else {
            echo '<td>' . $i * $k . '</td>';
        }
    }
    echo '</tr>';
}
?>
 </table>

 <ul>
     <?php for ($i = 1; $i <= 10; $i++):?>
        <li><?php echo $i ?></li>
     <?php endfor; ?>
 </ul>

</body>
</html>