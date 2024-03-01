<?php
class Database
{
//    private $host="157.90.133.74";
    private $host="localhost";
    private $dbName="vpnguy_dopotify";
    private $username="vpnguy_Django_AJ";
    private $password="Arm@nj@vadi83";
    private $connection;
    public function connect()
    {
        $this->connection=null;
        try {
            $this->connection=new PDO("mysql:host=$this->host;dbname=$this->dbName",$this->username,$this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            echo "Showing This Message is Cause an Error to Connecting to Database!<br>";
            echo $e->getMessage();
            echo "Please Contact Admin";
        }
        return $this->connection;
    }
}



?>