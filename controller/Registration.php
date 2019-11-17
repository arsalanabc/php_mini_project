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

    public function signup ($data){
	    $data['error'] = array() ;
	    if(self::is_empty($data['first_name'])){array_push($data["error"], "First Name cannot be empty");}
	    if(self::is_empty($data['last_name'])) {array_push($data["error"], "Last Name cannot be empty");}
        if(self::is_empty($data['username'])) { array_push($data["error"],"Username cannot be empty");}
        if(self::is_empty($data['email'])) { array_push($data["error"],"Email cannot be empty");}
        if(self::is_empty($data['password'])) {array_push($data["error"],"Password cannot be empty");}
        if(self::is_empty($data['password_confirm'])) {array_push($data["error"], "Password Confirm cannot be empty");}

        if(!self::validate_passwords($data['password'], $data['password_confirm'])) {array_push($data["error"], "Passwords do not match");}

        if(sizeof($data['error']) > 0){return $data;}

    }

    static function is_empty($field ) {
        return $field == "";
	}

	static function validate_passwords ($pass1, $pass2){
	    return $pass1 == $pass2;
    }
}
?>