<?php

function genericFindAll(string $tableName) {
    $sql = "SELECT * FROM `$tableName`"; 
    $result = getPDO()->query($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function genericInsert(array $inputs, string $tableName): int{
    $columnList = implode(", ", array_keys($inputs));
    $placeholders = implode(", :", array_keys($inputs));

    $sql = "INSERT INTO `$tableName` ($columnList) VALUES (:$placeholders)";
    
    $pdo = getPDO();
    $statement = $pdo->prepare($sql);
    $statement->execute($inputs);

    return $pdo->lastInsertId();
}

function getOPtionsForSelect(array $data, array $columnsName) {
    $html = "";
    foreach($data as $row) {

        $columnValues = array_map(function($item) use ($row){
                return $row[$item];
            }, 
            $columnsName
        );

        $label = implode(' ', $columnValues);

        $html .= "<option value=\"{$row['id']}\">{$label}</option>";
    }
    return $html;
}