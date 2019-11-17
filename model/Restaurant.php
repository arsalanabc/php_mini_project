<?php


class Restaurant
{
    private $id;
    private $name;
    private $DATABASE_CONN;

    function __construct($db, $name)
    {
        $this->DATABASE_CONN = $db;
        $this->name = $name;
    }

    public function add () {
        $query = "INSERT INTO restaurants (name) 
                VALUES ('$this->name')";
        $result = mysqli_query($this->DATABASE_CONN, $query) or die("Sign up failed: " . $this->DATABASE_CONN->connect_error);
        $this->id = mysqli_insert_id($this->DATABASE_CONN);
        return $this->id;
    }

}