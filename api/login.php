<?php
include "requireAll.php";
if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (isset($_GET['username']) && isset($_GET['password'])) {
//        $username = strtolower(htmlspecialchars($_GET['username']));
//        $password = strtolower(htmlspecialchars($_GET['password']));
        $username = htmlspecialchars($_GET['username']);
        $password = htmlspecialchars($_GET['password']);
        $database = new Database();
        $dbConnection = $database->connect();
        $user = new Users($dbConnection);
        $result = $user->selectSpecificUser($_GET['username'], $_GET['password']);
//        $row=$result->rowCount();
        if ($result) {
        $userData=[];
        $data=$result->fetch();
        extract($data);
                $userFetchedData=[
                    "id" => $id,
                    "firstname" => $user_firstname,
                    "lastname" => $user_lastname,
                    "password" => $user_password,
                    "email" => $user_email,
                    "username" => $user_username,
                    "role" => $user_role,

                ];
                array_push($userData,$userFetchedData);
                echo json_encode($userData);

        }
        else {
            echo json_encode(
                [
                    "code" => "404",
                    "status" => "user with this username or password not found"
                ]
            );
        }
    }
    else{
        echo json_encode(
            [
                "status"=>"400",
                "error"=>"Bad Parameters Request"
            ]
        );
    }
}
else{
    echo json_encode(
        [
            "status"=>"400",
            "error"=>"Bad Request"
        ]
    );
}