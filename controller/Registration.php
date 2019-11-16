<?php

class Registration {
	private $DB;
	function __construct($db){
		$this->DB = $db;
	}

	public function login ($username, $password){
	    if($username !== "" && $password !== ""){
	        $login_query = "SELECT * FROM users WHERE username='$username'
               AND password='md5($password)'";
	        $result = mysqli_query($this->DB, $login_query);
	        if($result->num_rows > 0){
	            echo "login pass";
            } else {
	            echo "login failed";
            }
        }
    }
}
?>