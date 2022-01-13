<?php
// Connexion au serveur de BD
$db = new PDO(
    "mysql:host=127.0.0.1;dbname=formation_cda_2022;charset=utf8",
    "root",
    ""
);

// Récupération des paramètres du script transmis dans l'url
$id = (int) filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

$isPosted = filter_has_var(INPUT_POST, "first_name");

// Traitement du formulaire
if($isPosted){
    // Récupération des données
    $firstName = filter_input(INPUT_POST, "first_name", FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, "last_name", FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!empty(trim($lastName)) && ! empty(trim($firstName))){
        $queryParams = [$firstName, $lastName];

        if(empty($id)){
            $sql = "INSERT INTO persons (first_name, last_name) VALUES (?, ?)";
        } else {
            $sql = "UPDATE persons SET first_name=?, last_name=? WHERE id=?";
            $queryParams[] = $id;
        }
        
        $statement = $db->prepare($sql);
        $statement->execute($queryParams);
        header("Location: " . getLinkToRoute("pdo_persons"));
    }
}

// Gestion de la suppression
if($id && $action === "delete"){
    $sql = "DELETE FROM persons WHERE id=$id";
    $db->exec($sql);
    header("Location: ". getLinkToRoute("pdo_persons"));
}

// En cas de modification, récupération des infos
// de la personne à modifier
if($id && $action === "update"){
    $sql = "SELECT * FROM persons WHERE id=$id";
    $result = $db->query($sql);
    $currentPerson = $result->fetch(PDO::FETCH_OBJ);
} else {
    $currentPerson = new StdClass();
    $currentPerson->first_name = "";
    $currentPerson->last_name = "";
    $currentPerson->id = null;
}

// Requête pour lister toutes les personnes
$result = $db->query("SELECT * FROM persons");

$data = $result->fetchAll(PDO::FETCH_OBJ);


// Affichage de la vue
echo render("persons", [
    "personList" => $data,
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


