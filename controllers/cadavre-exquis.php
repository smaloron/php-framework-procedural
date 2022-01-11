<?php
$nom = [
    "le formateur", "le chat", "le chien", "l'enfant", "le poisson", "l'ordinateur", "le président", "le docteur",
];

$verbe = [
    "mange", "consulte", "admire", "engueule", "cherche", "oublie", "regarde",
];

$complement = [
    "avec ostentation", "dans la chambre", "dans la cuisine", "au bistro", "sans en avoir l'air", "avec délectation", "sans vergogne",
];

for ($i = 1; $i <= 10; $i++) {
    $phrase = "{$nom[array_rand($nom)]} {$verbe[array_rand($verbe)]} {$nom[array_rand($nom)]} {$complement[array_rand($complement)]} <br>";

    echo $phrase;

}
