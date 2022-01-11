<?php

/**
 * Transforme un nom selon la convention snake_case
 * en un nom selon la convention camelCase
 * @param string $varName
 * @return string
 */
function snakeCaseToCamelCase(string $varName): string {
    $arrayName = explode('_', $varName);
    for($i=1; $i < count($arrayName); $i++) {
        $arrayName[$i] = ucfirst($arrayName[$i]);
    }

    return implode('', $arrayName );
}