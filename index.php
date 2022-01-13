<?php
session_start();
session_regenerate_id(true);

// Configuration de l'application
define("DSN", "mysql:host=127.0.0.1;dbname=formation_cda_2022;charset=utf8");
define("DB_USER", "root");
define("DB_PASS", "");

// inclusion des bibliothèques
require "lib/flash.php";
require "lib/framework.php";

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

    header("location:". getLinkToRoute('login'));
    exit;
}

// Table de routage
$routes = [
    "telechargement" => "upload",
    "contact" => "formulaire",
    "test-lib" => "include_tools"
];

// Gestion du routage
// Cette fonction nous retourne deux variables
// $controller et $controllerPath
extract(getRouteInfos($page, $routes), EXTR_OVERWRITE);

require $controllerPath;