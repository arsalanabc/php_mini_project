<?php
require_once "../config/Database.php";

// require queries for schemas
require_once "USER_TABLE.php";
require_once "RESTAURANT_TABLE.php";
require_once "USER_RESTAURANT.php";
require_once "REVIEW_TABLE.php";
require_once "RESTAURANT_REVIEW.php";

$db = new Database();
$conn = $db->get_connection();

function run($conn, $query, $msg){
    if(mysqli_query($conn, $query)){
        echo $msg;
    } else {
        echo "Error :" . $conn->error;
    }
}

run($conn, $drop_users_table, "Delete users table");
run($conn, $create_users_table, "Create users table");

run($conn, $drop_restaurants_table, "Drop restaurants table");
run($conn, $create_restaurants_table, "Create restaurants table");
////
run($conn, $drop_user_restaurant_table, "Delete user_rest table");
run($conn, $create_user_restaurant_table, "Create user_rest table");

run($conn, $drop_reviews_table, "Drop reviews table");
run($conn, $create_reviews_table, "Create reviews table");
//
run($conn, $drop_restaurant_review_table, "Create rest_reviews table");
run($conn, $create_restaurant_review_table, "Create rest_reviews table");
