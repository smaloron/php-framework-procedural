<?php


echo render("home", ["title" => "test du rendu de home"]);

/*
ob_start();

echo "Hello";
$title = "test";
include "views/home.php";

$output = ob_get_clean();

var_dump($output);
*/