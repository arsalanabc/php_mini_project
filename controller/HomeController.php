<?php

include BASE_PATH."/controller/Registration.php";
include_once BASE_PATH."/model/User.php";
include BASE_PATH."/model/Restaurant.php";
include BASE_PATH."/model/Review.php";

class HomeController
{
    private $DATABASE_CONN;

    function __construct($conn)
    {
        $this->DATABASE_CONN = $conn;
    }

    public function index($post_data)
    {
        if (!Registration::is_logged_in()) {
            header("Location: " . SITE_URL . "/index.php");
            return false;
        }
        if(isset($post_data['logout'])){$this->logout();return false;}

        $user = new User($this->DATABASE_CONN);
        $user->set_user_id( $_SESSION['user_id']);

        if(isset($post_data['add_restaurant'])){
            $this->add_restaurant($post_data, $user);
        }

        $data['user'] = $user;
        $data['restaurants'] = $this->get_restaurants($user);

        function getname($r){return $r->get_name();}
        $data['restaurant_names'] = array_map('getname', $data['restaurants']);

        return $data;
    }

    public function add_restaurant($restaurant_data, $user)
    {
        $restaurant_name = $restaurant_data['restaurant_name'];
        $review_text = $restaurant_data['review'];
        $restaurant = new Restaurant($this->DATABASE_CONN);
        $restaurant->set_name($restaurant_name);
        $restaurant->set_user($user);

        $restaurant->add_review(new Review($review_text));
        $restaurant->sync();
    }

    public function get_restaurants($user)
    {
        $restaurants = array();
        $user_id = $user->get_user_id();
        $query = "SELECT r.* FROM user_restaurant as ur LEFT JOIN restaurants as r ON ur.restaurant_id=r.id WHERE ur.user_id='$user_id'";
        $result = mysqli_query($this->DATABASE_CONN, $query);

        while ($row = mysqli_fetch_object($result)) {
            $new_restaurant = new Restaurant($this->DATABASE_CONN);
            $new_restaurant->set_name($row->name);
            $new_restaurant->set_user($user);
            $new_restaurant->set_id($row->id);
            array_push($restaurants, $new_restaurant);
        }

        return $restaurants;
    }

    public function logout()
    {
        Registration::logout();
    }
}
?>