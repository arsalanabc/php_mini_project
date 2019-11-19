<?php


class Database
{
    private $SERVERNAME;
    private $USERNAME;
    private $PASSWORD;
    private $DBNAME;

    function __construct()
    {
        $this->SERVERNAME = "127.0.0.1";
        $this->USERNAME = "root";
        $this->PASSWORD = "";
        $this->DBNAME = "";
    }

    public function get_connection(){
        $conn = mysqli_connect($this->SERVERNAME, $this->USERNAME, $this->PASSWORD, $this->DBNAME);
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}