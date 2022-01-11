<?php
session_start();
session_regenerate_id(true);

// inclusion des bibliothèques
require "lib/flash.php";

// Récupération du nom du contrôleur
// par défaut "intro"
$page = filter_input(INPUT_GET, "page") ?? "intro";

// Routes sécurisées
$securedRoutes = [
    "cadavre-exquis", "formulaire", "contact"
];

// Redirection vers login 
// quand on est anonyme et que l'on veut accèder 
// à une route sécurisée
if(in_array($page, $securedRoutes ) && ! isset($_SESSION["user"])){
    addFlash("Vous devez être authentifié pour accèder à la page $page");
    $_SESSION["redirectPage"] = $page;
    header("location:index.php?page=login");
    exit;
}

// Table de routage
$routes = [
    "telechargement" => "upload",
    "contact" => "formulaire",
    "test-lib" => "include_tools"
];

// Résolution du routage
if(array_key_exists($page, $routes)){
    $controller = $routes[$page];
} else {
    $controller = $page;
}

// Gestion d'un contrôleur dont le fichier n'existe pas
$controllerPath = "controllers/$controller.php";
if(! file_exists($controllerPath)){
    $controllerPath = "controllers/not_found.php";
}

require $controllerPath;