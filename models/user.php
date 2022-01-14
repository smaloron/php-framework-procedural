<?php

define("USER_PATH", "data/users.json");

function getUserList(): array{
    $data = file_get_contents(USER_PATH, true);
    return json_decode($data, true);
}

function authenticateUser(string $login, string $password): bool {
    $sql = "SELECT user_password FROM users WHERE user_login = ?";
    $statement = getPDO()->prepare($sql);
    $statement->execute([$login]);
    $user = $statement->fetch(PDO::FETCH_OBJ);
    if($user === false) {
        return false;
    }

    return password_verify($password, $user->user_password);
}

function saveUser(string $login, string $password, $id): void {
    $queryParams = [$login];

    if(empty($id)){
        $queryParams[] = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (user_login, user_password) VALUES (?, ?)";
    } else {
        $queryParams[] = $id;
        $sql = "UPDATE users set user_login=? WHERE id = ?";
    }

    $statement = getPDO()->prepare($sql);
    $statement->execute($queryParams);
}