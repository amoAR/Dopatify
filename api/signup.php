<?php
include "requireAll.php";
if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_GET['firstname']) && isset($_GET['lastname'])
        && isset($_GET['username']) && isset($_GET['password'])
        && isset($_GET['email'])){
//        $username = strtolower(htmlspecialchars($_GET['username']));
//        $password = (htmlspecialchars($_GET['password']));
        $firstName = htmlspecialchars($_GET['firstname']);
        $lastName = htmlspecialchars($_GET['lastname']);
        $username = htmlspecialchars($_GET['username']);
        $password = htmlspecialchars($_GET['password']);
        $email = htmlspecialchars($_GET['email']);
        $database = new Database();
        $dbConnection = $database->connect();
        $user = new Users($dbConnection);
        $result=$user->insert($firstName,$lastName,$username,$password,$email);
        if(!$result){
            echo json_encode(
                [
                    "status"=>"failed",
                    "message"=>"signup failed"
                ]
            );
        }
        else{
                echo json_encode(
                    [
                        "status"=>"success",
                        "message"=>"successfully signed up"
                    ]
                );
        }
    }
    else{
        echo json_encode(
            [
                "status"=>"ridi!"
            ]
        );
    }
}