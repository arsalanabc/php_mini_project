<?php

session_start();

class User {
    private $DATABASE_CONN;
    private $user_id;
    private $username;

    function __construct($db, $id)
    {
        $this->DATABASE_CONN = $db;
        $this->user_id = $id;
    }

    public function getUsername()
    {
        if(!$this->username){
            $login_query = "SELECT username FROM users WHERE id='$this->user_id'";
            $data = mysqli_query($this->DATABASE_CONN, $login_query);
            $user = mysqli_fetch_object($data);
            $this->username = $user->username;
        }
        return $this->username;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    static function is_login() {
        if(isset($_SESSION['user_id']) and $_SESSION['user_id']){
            return true;
        } else {
        return false;
        }
    }
}
?>