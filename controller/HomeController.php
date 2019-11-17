<?php

include BASE_PATH."/model/User.php";
include BASE_PATH."/model/Restaurant.php";

class HomeController {
    private $DATABASE_CONN;

    function __construct($conn)
    {
        $this->DATABASE_CONN = $conn;
    }

    public function index () {
        if(!User::is_login()){
            header("Location: ".SITE_URL."/index.php");
        }

        $user = new User($this->DATABASE_CONN, $_SESSION['user_id']);
        $data = $user;
        return $data;
    }

    public function add_restaurant ($restaurant_data) {
        $restaurant_name =  $restaurant_data['restaurant_name'];
        $review =  $restaurant_data['review'];

        $restaurant = new Restaurant($this->DATABASE_CONN, $restaurant_name);
        $restaurant->add();
    }
}
?>