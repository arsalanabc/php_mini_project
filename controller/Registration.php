<?php
require_once BASE_PATH."/ENV.php";
include_once BASE_PATH."/model/User.php";

session_start();

class Registration {
	private $DB;
	private $user;
	function __construct($db){
		$this->DB = $db;
		$this->user = new User($db);
	}

	public function login ($username, $password){
        $errors = array() ;
        if(self::is_empty($username)){array_push($errors, "Username cannot be empty");}
        if(self::is_empty($password)) {array_push($errors,"Password cannot be empty");}

        if(sizeof($errors) > 0){return $errors;}
        else {
	        if($this->user->login($username, $password)){
                if(User::is_login()){
                    echo "login successful".$_SESSION['user_id'];
//                    header("Location: ".SITE_URL."/index.php");
                }
            } else {
                $errors = ['Login failed, please make sure username and password are correct'];
                return $errors;
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
        else {
            if($this->user->sign_up($data)){
                $_SESSION['sign_up'] = true;
                header("Location: ".SITE_URL."/index.php");
            } else {
                 array_push($data["error"], "sign up failed, please try again");
                 return $data;
            }
        }
    }

    static function sign_up_message(){
	    if(isset($_SESSION['sign_up']) and $_SESSION['sign_up']){
	        echo "<h4> Sign up complete. Please login below </h4>";
            unset($_SESSION['sign_up']);
        } else {
            echo "<p>Please login below or sign up <a href=\"".SITE_URL."/view/registration/signup.php\"> here </a> </p>";
        }
    }

    static function is_empty($field ) {
        return $field == "";
	}

	static function validate_passwords ($pass1, $pass2){
	    return $pass1 == $pass2;
    }
}
?>