<?php
require "models/user.php";

$isPosted = filter_has_var(INPUT_POST, "user_login");
$error = "";



if ($isPosted) {
    $login = filter_input(INPUT_POST, "user_login", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "user_password");

    if(! empty($login) && ! empty($password)){
        try {
            saveUser($login,$password, null);
            $_SESSION["user"] = $login;
            header("location:". getLinkToRoute("home"));
            exit;
        } catch(PDOException $ex) {
            $error = "Impossible d'enregistrer votre saisie dans la BD <br>". $ex->getMessage();
        }
    } else{
        $error = "Vous devez saisir les informations";
    }

}


echo render("register", ["error" => $error]);