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
            addFlash("Vous êtes connecté");
            $redirect = $_SESSION["redirectPage"] ?? "home";
            unset($_SESSION["redirectPage"]);
            header("location:". getLinkToRoute($redirect));
            exit;
        } else {
            array_push($errors, "Vos infos de connection sont incorrectes");
        }
    }
}

echo render($controller, [
    "title" => "login",
    "hasErrors" => count($errors) > 0
]);

