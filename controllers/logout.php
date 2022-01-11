<?php

// Destruction de la session
session_destroy();

session_start();
session_regenerate_id();

addFlash("Vous êtes déconnecté");

// redirection
header("location:index.php?page=home");