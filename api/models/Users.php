<?php
class Users
{
    private $connection;
    private $table = 'users';

    //constructor
    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }

    //read all users table
    public function ReadAllUsers()
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //READ
    public function LoginUser($username = null, $email = null, $password)
    {
        //check input param
        $userField = null;
        if (is_null($username)) {
            $username = $email;
            $userField = 'user_email';
        }
        else {
            $userField = 'user_username';
        }

        //select query
        $query = "SELECT * FROM $this->table WHERE $userField=:username AND user_password=:password";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        //execute
        if ($stmt->execute() && $stmt->rowCount() > 0)
        {
            return $stmt;
        }
        else
        {
            return false;
        }
    }

    //CREATE
    public function CreateUser($username, $email, $password)
    {
        //insert query
        $query = "INSERT INTO $this->table (user_username, user_email, user_password) VALUES (:username, :email, :password)";
        $stmt  = $this->connection->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);

        //execute
        if ($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>