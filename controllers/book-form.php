<?php
require "models/generic.php";

$isPosted = filter_has_var(INPUT_POST, "titre");

if ($isPosted){
    $filters = [
        "titre" => FILTER_SANITIZE_STRING,
        "prix" => FILTER_SANITIZE_NUMBER_INT,
        "date_publication" => FILTER_SANITIZE_NUMBER_INT,
        "id_auteur" => FILTER_SANITIZE_NUMBER_INT,
        "id_editeur" => FILTER_SANITIZE_NUMBER_INT,
        "id_genre" => FILTER_SANITIZE_NUMBER_INT,
        "id_langue" => FILTER_SANITIZE_NUMBER_INT
    ];

    $inputs = filter_input_array(INPUT_POST, $filters);

    try {
        $id = genericInsert($inputs, "livres");
        echo $id;
    } catch(PDOException $ex){
        echo $ex->getMessage();
    }
    
}

echo render("book-form", [
    "authorOptions" => getOPtionsForSelect(
        genericFindAll("auteurs"), 
        ["prenom", "nom"]
    ),
    "publisherOptions" => getOPtionsForSelect(
        genericFindAll("editeurs"), 
        ["nom"]
    ),
    "genreOptions" => getOPtionsForSelect(
        genericFindAll("genres"), 
        ["genre"]
    ),
    "languageOptions" => getOPtionsForSelect(
        genericFindAll("langues"), 
        ["langue"]
    )
]);