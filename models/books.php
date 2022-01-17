<?php

function countBooks(string $search){
    $searchQuery = "";
    $params = [];
    if(! empty($search)){
        $searchQuery = "WHERE auteur= :search OR genre= :search OR editeur= :search";
        $params = ["search" => $search];
    } 

    $sql = "SELECT COUNT(*) as nb FROM livres_simples $searchQuery ";

    
    $statement = getPDO()->prepare($sql);
    $statement->execute($params);
    $data = $statement->fetch();

    if($data !== false){
        return $data["nb"];
    } else {
        return 0;
    }
}

function findBooks(array $pagination, string $search){
    $sql = "SELECT * FROM livres_simples ";
    
    if(! empty($search)){
        $sql .= "WHERE
                auteur= :search OR genre= :search OR editeur= :search";
    }

    $sql .= " LIMIT :limit OFFSET :offset";
    

    $offset = ($pagination["currentPage"] -1) * $pagination["numberPerPage"];
    $limit = $pagination["numberPerPage"];

    $statement = getPDO()->prepare($sql);

    $statement->bindValue("limit", $limit, PDO::PARAM_INT);
    $statement->bindValue("offset", $offset, PDO::PARAM_INT);
    if(! empty($search)){
        $statement->bindValue("search", $search, PDO::PARAM_STR);
    }


    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_OBJ);
}