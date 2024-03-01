<?php

class Users
{
    private $connection;
    private $table= "users";
    public function __construct($dbConnection)
    {
        $this->connection=$dbConnection;
    }
    public function read()
    {
        $query="SELECT * FROM $this->table";
        $stmt=$this->connection->prepare($query);
        $stmt->execute();
        return $stmt;

    }
    public function selectSpecificUser($username,$password)
    {
        $query ="SELECT * FROM `users` WHERE `user_username`=? AND `user_password`=?";
;
        $stmt=$this->connection->prepare($query);
        if(!$stmt->execute($username,$password)){
            die("Error");
        }
        else{
            return $stmt;
        }

    }
    public function insert($firstname,$lastname,$username,$password,$email,$role="user")
    {
        $query="INSERT INTO $this->table (user_firstname,user_lastname,user_username,user_password,user_email,user_role)
                VALUES (?,?,?,?,?,?)";
        $stmt=$this->connection->prepare($query);
        if(!$stmt->execute($firstname,$lastname,$username,$password,$email,$role)){
            return 0;
        }
        else{
            return 1;
        }
    }
}