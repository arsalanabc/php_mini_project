<?php

session_start();

class User {
    private $DATABASE_CONN;
    private $user_id;
    private $username;

    function __construct($db)
    {
        $this->DATABASE_CONN = $db;
    }

    public function set_user_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function get_username()
    {
        if(!$this->username){
            $login_query = "SELECT username FROM users WHERE id='$this->user_id'";
            $data = mysqli_query($this->DATABASE_CONN, $login_query);
            $user = mysqli_fetch_object($data);
            $this->username = $user->username;
        }
        return $this->username;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }
}
?>