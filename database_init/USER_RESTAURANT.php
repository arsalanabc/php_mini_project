<?php

$drop_user_restaurant_table = "DROP TABLE IF EXISTS `user_restaurant`";

$create_user_restaurant_table = "CREATE TABLE `user_restaurant` (
   `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   `user_id` int(10) NOT NULL,
   `restaurant_id` int(10) NOT NULL UNIQUE
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

?>