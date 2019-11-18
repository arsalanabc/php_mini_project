<?php

include BASE_PATH."/model/User.php";
include BASE_PATH."/model/Restaurant.php";
include BASE_PATH."/model/Review.php";

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
        $data['user'] = $user;
        $data['restaurants'] = $this->get_restaurants($user);
        return $data;
    }

    public function add_restaurant ($restaurant_data, $user) {
        $restaurant_name =  $restaurant_data['restaurant_name'];
        $review_text =  $restaurant_data['review'];
        $restaurant = new Restaurant($this->DATABASE_CONN, $restaurant_name, $user);

        $review = new Review($review_text);
        $restaurant->add_review($review);
        $restaurant->sync();
    }

    public function get_restaurants($user){
        $restaurants = array();
        $user_id = $user->getUserId();
        $query = "SELECT r.* FROM user_restaurant as ur LEFT JOIN restaurants as r ON ur.restaurant_id=r.id WHERE ur.user_id='$user_id'";
        $result = mysqli_query($this->DATABASE_CONN, $query);

        while($row=mysqli_fetch_object($result)) {
            $new_restaurant = new Restaurant($this->DATABASE_CONN, $row->name, $user);
            $new_restaurant->setId($row->id);
            array_push($restaurants, $new_restaurant);
        }

        return $restaurants;
    }
}
?>