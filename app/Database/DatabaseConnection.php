<?php

class DatabaseConnection
{
    //Database connection
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "productsdb";
    private $connection;

    function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("connection failed:" . $this->connection->connect_error);
        }
    }

    // Code for DQL => Data Query Language
    // This function is for 'SELECT'
    public function runDQL($query)
    {
        $result = $this->connection->query($query);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return [];
        }
    }

    // Code for DML => Data Manipulation Language
    // This function is for 'INSERT,UPDATE,DELETE'
    public function runDML($query)
    {
        $result = $this->connection->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
