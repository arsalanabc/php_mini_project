<?php

class Restaurant
{
    private $id;
    private $name;
    private $DATABASE_CONN;
    private $creator;
    private $reviews = array();

    function __construct($db)
    {
        $this->DATABASE_CONN = $db;
    }

    public function add_review ($review){
        array_push($this->reviews, $review);
    }

    public function sync() {
        if(!$this->id){
            $this->add();
        } else {
            $this->update();
        }
    }

    public function get_reviews()
    {
        $reviews = array();
        $query = "SELECT r.* FROM restaurant_review as rr 
                    LEFT JOIN reviews as r ON rr.review_id=r.id 
                    WHERE rr.restaurant_id='$this->id'";
        $result = mysqli_query($this->DATABASE_CONN, $query);

        while($row=mysqli_fetch_object($result)) {
            $new_restaurant = new Review($row->content, $row->timestamp);
            $new_restaurant->set_id($row->id);
            array_push($reviews, $new_restaurant);
        }
        return $reviews;
    }

    public function set_user($user){
        $this->creator = $user;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    private function add() {
        $user_id = $this->creator->get_user_id();

        $query = "SELECT r.id FROM user_restaurant as ur JOIN restaurants as r ON ur.restaurant_id=r.id AND r.name='$this->name' WHERE ur.user_id='$user_id'";
        $check_restaurant_name = mysqli_query($this->DATABASE_CONN, $query) or die($this->DATABASE_CONN->connect_error);

        if($check_restaurant_name->num_rows > 0){
            $this->id = mysqli_fetch_object($check_restaurant_name)->id;
        } else {
            $query = "INSERT INTO restaurants (name) VALUES ('$this->name')";
            $result = mysqli_query($this->DATABASE_CONN, $query) or die($this->DATABASE_CONN->connect_error);
            $this->id = mysqli_insert_id($this->DATABASE_CONN);
            $join_query = "INSERT INTO user_restaurant (user_id, restaurant_id) VALUES ('$user_id','$this->id')";
            $result = mysqli_query($this->DATABASE_CONN, $join_query) or die($this->DATABASE_CONN->connect_error);
        }

        $this->update();
    }

    private function update () {
        foreach ($this->reviews as $review){
            if(!$review->get_id()){
                $content = $review->get_content();

                $review_query = "INSERT INTO reviews (content) VALUES ('$content')";
                $result = mysqli_query($this->DATABASE_CONN, $review_query) or die($this->DATABASE_CONN->connect_error);
                $review_id = mysqli_insert_id($this->DATABASE_CONN);
                $review->set_id($review_id);
                array_push($this->reviews, $review);

                $join_query = "INSERT INTO restaurant_review (review_id, restaurant_id) VALUES ('$review_id', '$this->id')";
                $result = mysqli_query($this->DATABASE_CONN, $join_query) or die($this->DATABASE_CONN->connect_error);
            }
        }
    }

}