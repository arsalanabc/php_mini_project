<?php

class User {
    private $DATABASE_CONN;
    function __construct($db)
    {
        $this->DATABASE_CONN = $db;
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

    private function clean_string($string){
        return $this->DATABASE_CONN->real_escape_string($string);
}

}
?>