<?php

class Database
{
     public $host = 'localhost';
    private $db_name = "associacao";

    private $username = "root";

    private $password = "";

    public $conn;

    public function getconnection()
    {
        $this->conn = null;
        try
        {
            $this->conn = new PDO("myaql:host=". $this->host. ";dbname=" . $this->db_name, $this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }catch (PDOException $exception)
        {
            echo "Connectio error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

