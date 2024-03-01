<?php

include "requireAll.php";

#Database Connection
$database = new Database();
$dbConnection = $database->connect();

#Users Instance;
$user = new Users($dbConnection);
$result = $user->ReadAllUsers();
$row = $result->rowCount();

if ($row)
{
    $users = [];
    while ($data = $result->fetch())
    {
        extract($data);
        $usersData = [
            "id" => $id,
            "firstname" => $user_firstname,
            "lastname" => $user_lastname,
            "password" => $user_password,
            "email" => $user_email,
            "username" => $user_username,
            "role" => $user_role,

        ];
        array_push($users, $usersData);
    }
    echo json_encode($users);
}
else
{
    echo json_encode(
        ["message" => "No User Found!"]
    );
}
