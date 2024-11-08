<?php

class Database
{
    private $host = "localhost";
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
        }
    }
}

