<?php
require_once "../config/db_config.php";

// require queries for schemas
require "USER_TABLE.php";

function run($conn, $query, $msg){
    if(mysqli_query($conn, $query)){
        echo $msg;
    } else {
        echo "Error :" . $conn->error;
    }
}

run($conn, $drop_users_table, "Delete user table");
run($conn, $create_users_table, "Create user table");




