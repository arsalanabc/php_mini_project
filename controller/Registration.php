<?php
require_once BASE_PATH."/ENV.php";
include_once BASE_PATH."/model/User.php";


class Registration {
	private $DB;
	function __construct($db){
		$this->DB = $db;
	}

	public function login ($email, $password){
        $errors = array() ;
        if(self::is_empty($email)){array_push($errors, "Email cannot be empty");}
        if(self::is_empty($password)) {array_push($errors,"Password cannot be empty");}

        if(sizeof($errors) > 0){return $errors;}
        else {
            $login_query = "SELECT id FROM users WHERE email='$email' AND password=md5('$password')";
            $result = mysqli_query($this->DB, $login_query);
            $login_data = mysqli_fetch_object($result);
            if($result->num_rows > 0){
                $_SESSION['user_id'] = $login_data->id;
                if(self::is_logged_in()){
                    header("Location: ".SITE_URL."/view/home/index.php");
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
            if($this->signup_logic($data)){
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

    static function is_logged_in (){
        return (isset($_SESSION['user_id']) and $_SESSION['user_id']);
    }

    static function logout (){
        session_destroy();
        header("Location: ".SITE_URL."/index.php");
    }

    private function signup_logic ($data){
        $username = $this->clean_string($data['username']);
        $email = $this->clean_string($data['email']);
        $first_name = $this->clean_string($data['first_name']);
        $last_name = $this->clean_string($data['last_name']);
        $password = md5($data['password']);

        $query = "INSERT INTO users (username, email, first_name, last_name, password) 
                VALUES ('$username','$email', '$first_name', '$last_name', '$password')";
        $result = mysqli_query($this->DB, $query) or die("Sign up failed: " . $this->DB->connect_error);
        return $result;
	}

    private function clean_string($string){
        return $this->DB->real_escape_string($string);
    }
}
?>