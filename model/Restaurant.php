<?php


class Restaurant
{
    private $id;
    private $name;
    private $DATABASE_CONN;
    private $creator;
    private $reviews = array();

    function __construct($db, $name, $creator)
    {
        $this->DATABASE_CONN = $db;
        $this->name = $name;
        $this->creator = $creator;
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

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    private function add () {
        $query = "INSERT INTO restaurants (name) 
                VALUES ('$this->name')";
        $result = mysqli_query($this->DATABASE_CONN, $query) or die($this->DATABASE_CONN->connect_error);
        $this->id = mysqli_insert_id($this->DATABASE_CONN);
        $user_id = $this->creator->getUserId();
        $join_query = "INSERT INTO user_restaurant (user_id, restaurant_id) 
                VALUES ('$user_id','$this->id')";
        $result = mysqli_query($this->DATABASE_CONN, $join_query) or die($this->DATABASE_CONN->connect_error);

        $this->update();
        return $this->id;
    }

    private function update () {
        foreach ($this->reviews as $review){
            if(!$review->getId()){
                $content = $review->getContent();
                $review_query = "INSERT INTO reviews (content) VALUES ('$content')";
                $result = mysqli_query($this->DATABASE_CONN, $review_query) or die($this->DATABASE_CONN->connect_error);
                $review_id = mysqli_insert_id($this->DATABASE_CONN);
                $review->setId($review_id);

                $join_query = "INSERT INTO restaurant_review (review_id, restaurant_id) VALUES ('$review_id', '$this->id')";
                $result = mysqli_query($this->DATABASE_CONN, $join_query) or die($this->DATABASE_CONN->connect_error);
            }
        }
    }

}