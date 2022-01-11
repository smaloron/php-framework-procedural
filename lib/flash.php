<?php

/**
 * Définition d'un message flash
 *
 * @param string $message
 * @return void
 */
function addFlash(string $message): void {
    $_SESSION["flash"] = $message;
}

/**
 * Récupération du message flash
 * et suppression de celui-ci dans la session
 * @return string
 */
function getFlash(): string {
    $message = $_SESSION["flash"];
    unset($_SESSION["flash"]);
    return $message;
}

/**
 * test de l'existence d'un message flash
 *
 * @return boolean
 */
function hasFlash(): bool {
    return isset($_SESSION["flash"]);
}