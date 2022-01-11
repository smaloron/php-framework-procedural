<?php 
    $name = $_POST["userName"] ?? "";
    $age = $_POST["userAge"] ?? "";

    if(empty($age)) $age= 19;
    if(empty($name)) $name="User";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitement du formulaire </title>
</head>
<body>
    <h1>Bonjour <?= $name ?> vous avez <?= $age ?> ans
</body>
</html>