<?php

/**
 * Retourne la liste des personnes depuis la base de données
 *
 * @return array
 */
function findAllPersons(): array{
    $result = getPDO()->query("SELECT * FROM persons");
    $data = $result->fetchAll(PDO::FETCH_OBJ);
    return $data ?? [];
}

function deleteOnePersonById(int $id): void{
    $sql = "DELETE FROM persons WHERE id=$id";
    getPDO()->exec($sql);
}

function getOnePersonById(int $id): StdClass {
    $sql = "SELECT * FROM persons WHERE id=$id";
    $result = getPDO()->query($sql);
    $currentPerson = $result->fetch(PDO::FETCH_OBJ);

    return $currentPerson ?? getEmptyPerson();
}

function getEmptyPerson(): StdClass{
    $currentPerson = new StdClass();
    $currentPerson->first_name = "";
    $currentPerson->last_name = "";
    $currentPerson->id = null;
    return $currentPerson;
}

function savePerson(int $id, string $firstName, string $lastName) : void{
    $queryParams = [$firstName, $lastName];

    if (empty($id)) {
        $sql = "INSERT INTO persons (first_name, last_name) VALUES (?, ?)";
    } else {
        $sql = "UPDATE persons SET first_name=?, last_name=? WHERE id=?";
        $queryParams[] = $id;
    }

    $statement = getPDO()->prepare($sql);
    $statement->execute($queryParams);
}