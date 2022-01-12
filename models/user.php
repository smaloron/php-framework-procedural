<?php

define("USER_PATH", "data/users.json");

function getUserList(): array{
    $data = file_get_contents(USER_PATH, true);
    return json_decode($data, true);
}

function authenticateUser(string $login, string $password): bool {
    $userList = getUserList();
    $user = array_filter(
        $userList, 
        function($item) use ($login, $password) {
            return $item["login"] == $login && $item["password"] == $password;
        }
    );

    return count($user) > 0;
}