<?php

/**
 * Retourne les infos de routage en fonction de la requête
 * et d'une table de routage
 *
 * @param string $page
 * @param array $routes
 * @return array un tableau contenant le nom de la route et son chemin
 */
function getRouteInfos( string $page, 
                        array $routes, 
                        string $notFoundRoute = "not_found"): array{
    // Résolution du routage
    if (array_key_exists($page, $routes)) {
        $controller = $routes[$page];
    } else {
        $controller = $page;
    }

    // Gestion d'un contrôleur dont le fichier n'existe pas
    $controllerPath = "controllers/$controller.php";
    if (!file_exists($controllerPath)) {
        $controllerPath = "controllers/$notFoundRoute.php";
    }

    return [
        "controller" => $controller,
        "controllerPath" => $controllerPath
    ];

}