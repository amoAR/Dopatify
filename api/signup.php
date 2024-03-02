<?php
include "requireAll.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (
        isset($_POST['firstname']) && isset($_POST['lastname'])
        && isset($_POST['username']) && isset($_POST['password'])
        && isset($_POST['email'])
    )
    {
        $firstName = htmlspecialchars($_POST['firstname']);
        $lastName = htmlspecialchars($_POST['lastname']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $email = htmlspecialchars($_POST['email']);
        $database = new Database();
        $dbConnection = $database->connect();
        $user = new Users($dbConnection);
        $result = $user->CreateUser($username, $password, $email);
        if (!$result)
        {
            echo json_encode(
                [
                    "status" => "failed",
                    "message" => "signup failed"
                ]
            );
        }
        else
        {
            echo json_encode(
                [
                    "status" => "success",
                    "message" => "successfully signed up"
                ]
            );
        }
    }
    else
    {
        echo json_encode(
            [
                "status" => "ridi!"
            ]
        );
    }
}
