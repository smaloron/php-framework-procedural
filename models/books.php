<?php

function countBooks(string $search){
    $searchQuery = "";
    $params = [];
    if(! empty($search)){
        $searchQuery = "WHERE auteur= ? OR genre= ? OR editeur= ?";
        $params = [$search, $search, $search];
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
                auteur= ? OR genre= ? OR editeur=?";
    }

    $sql .= " LIMIT ? OFFSET ?";
    

    $offset = ($pagination["currentPage"] -1) * $pagination["numberPerPage"];
    $limit = $pagination["numberPerPage"];

    $statement = getPDO()->prepare($sql);

    if(! empty($search)){
        $statement->bindValue(1, $search, PDO::PARAM_STR);
        $statement->bindValue(2, $search, PDO::PARAM_STR);
        $statement->bindValue(3, $search, PDO::PARAM_STR);
        $statement->bindValue(4, $limit, PDO::PARAM_INT);
        $statement->bindValue(5, $offset, PDO::PARAM_INT);
    } else {
        $statement->bindValue(1, $limit, PDO::PARAM_INT);
        $statement->bindValue(2, $offset, PDO::PARAM_INT);
    }


    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_OBJ);
}