<?php

$isPosted = filter_has_var(INPUT_POST, "submit");
$errors = [];

if($isPosted){
    $login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "pwd", FILTER_DEFAULT);

    if(empty($login)){
        array_push($errors, "Vous devez saisir le login");
    }
    if (empty($password)) {
        array_push($errors, "Vous devez saisir le mot de passe");
    }

    if(count($errors) == 0){
        if($login == "user" && $password == "123"){
            $_SESSION["user"] = $login;
            header("location:index.php?page=home");
            exit;
        } else {
            array_push($errors, "Vos infos de connection sont incorrectes");
        }
    }
}

$hasErrors = count($errors) > 0;
$title = "login";

// Affichage de la vue
$template = "$controller.php";
// Affichage de la vue
require "views/gabarit.php";

