<?php
// Lecture des données
$skills = file_get_contents("data/skills.json");

$skillsAsArray = json_decode($skills, true);

$skillsAsObject = json_decode($skills);

echo render("skills", [
    "skills" => $skillsAsArray,
    "skillsObj" => $skillsAsObject
]);