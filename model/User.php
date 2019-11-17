<?php

session_start();

class User {
    private $DATABASE_CONN;
    function __construct($db)
    {
        $this->DATABASE_CONN = $db;
    }

    public function login ($username, $password){
        $login_query = "SELECT id FROM users WHERE username='$username'
              AND password=md5('$password')";
        $result = mysqli_query($this->DATABASE_CONN, $login_query);
        $login_data = mysqli_fetch_object($result);
        if($result->num_rows > 0){
            $_SESSION['user_id'] = $login_data->id;
            return true;
        } else {
            return false;
        }
    }

    public function sign_up ($data) {
        $username = $this->clean_string($data['username']);
        $email = $this->clean_string($data['email']);
        $first_name = $this->clean_string($data['first_name']);
        $last_name = $this->clean_string($data['last_name']);
        $password = md5($data['password']);

        $query = "INSERT INTO users (username, email, first_name, last_name, password) 
                    VALUES ('$username','$email', '$first_name', '$last_name', '$password')";
        $result = mysqli_query($this->DATABASE_CONN, $query) or die("Sign up failed: " . $this->DATABASE_CONN->connect_error);
        return $result;
    }

    static function is_login() {
        if(isset($_SESSION['user_id']) and $_SESSION['user_id']){
            return true;
        } else {
        return false;
        }
    }

    private function clean_string($string){
        return $this->DATABASE_CONN->real_escape_string($string);
    }

}
?>