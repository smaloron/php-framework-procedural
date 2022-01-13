<?php
require "models/person.php";

// Connexion au serveur de BD
$db = getPDO();

// Récupération des paramètres du script transmis dans l'url
$id = (int) filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

$isPosted = filter_has_var(INPUT_POST, "first_name");

// Traitement du formulaire
if($isPosted){
    // Récupération des données
    $firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING);
    $id = (int) filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!empty(trim($lastName)) && ! empty(trim($firstName))){
        savePerson($id, $firstName, $lastName);
        header("Location: " . getLinkToRoute("pdo_persons"));
        exit;
    }
}

// Gestion de la suppression
if($id && $action === "delete"){
    deleteOnePersonById($id);
    header("Location: ". getLinkToRoute("pdo_persons"));
    exit;
}

// En cas de modification, récupération des infos
// de la personne à modifier
$currentPerson = getEmptyPerson();
if($id && $action === "update"){
    $currentPerson = getOnePersonById($id);
}

// Affichage de la vue
echo render("persons", [
    "personList" => findAllPersons(),
    "currentPerson" => $currentPerson
]);


/*
Récupération des résultats dans une boucle while
$row = $result->fetch(PDO::FETCH_OBJ);
while ( $row !== false) {
    echo "<p> {$row->first_name} {$row->last_name}</p>";
    $row = $result->fetch(PDO::FETCH_OBJ);
} 
*/


/*
Récupération des résultats un à un

$row = $result->fetch(PDO::FETCH_ASSOC);
var_dump($row);
echo "<p> {$row['first_name']} {$row['last_name']}</p>";

$row = $result->fetch(PDO::FETCH_NUM);
var_dump($row);
echo "<p> {$row[2]} {$row[1]}</p>";

$row = $result->fetch(PDO::FETCH_NUM);
var_dump($row);
echo "<p> {$row[2]} {$row[1]}</p>";
*/


