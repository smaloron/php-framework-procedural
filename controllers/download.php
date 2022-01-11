<?php
$fileName = 'participants.csv';
header("Content-type:application/csv");
// filename permet de suggérer un nom de fichier
header("Content-Disposition:attachment;filename='$fileName'");
// Affichage du contenu
echo "nom;age\n";
echo "Pierre;20\n";
echo "Jean;32\n";
echo "Odile;40\n";
