<?php

function hello ($name = "world") {
    echo "Hello $name <br>";
}

$hola = function($name){
    echo "Hola $name <br>";
};

$f = "hola";

$f2 = "hello";

hello("Seb"); 

$hola("Jen");

$$f("Paul");

$f2("John");

hello();

/**
 * Fait la somme d'une liste d'entiers
 * et retourne cette somme avec un préfixe
 * Exemple : add("la somme est", 5, 6, 9)
 *
 * @param string $message le préfixe
 * @param integer ...$numbers la liste des nombres
 * @return string
 */
function add(string $message, int ...$numbers): string
{
    $total = 0;
    foreach ($numbers as $n) {
        $total += $n;
    }
    return $message . $total;
}
echo add("le résultat est : ", 5, 8, 2, 8);


function addString(string &$str)
{
    $str .= " dans un pays fort lointain";
}
$str = "Il était une fois";
addString($str);
echo $str;

