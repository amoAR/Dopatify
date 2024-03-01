<?php
class Database
{
    private $host = 'localhost';
    private $dbName = 'vpnguy_dopotify';
    private $username = 'vpnguy_Django_AJ';
    private $password = 'Arm@nj@vadi83';
    
    private $connection;

    public function connect()
    {
        //success
        try
        {
            $dsn  = "mysql:host=$this->host;dbname=$this->dbName;charset=utf8";
            $opts = [
                PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE       => PDO::FETCH_ASSOC
            ];

            $this->connection = new PDO($dsn, $this->username, $this->password, $opts);
            $this->connection->exec('SET NAMES UTF8');
        }
        // error
        catch (PDOException $e)
        {
            switch ($e->getCode()){
                case 2002:
                    die("No such host is known.");
                case 1049:
                    die("Unknown database.");
                case 1045:
                    die("Access denied for user.");
                default:
                    throw $e->errorInfo[2];
            }
        }

        //return connection
        return $this->connection;
    }
}
?>