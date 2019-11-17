<?php

$drop_user_restaurant_table = "DROP TABLE IF EXISTS `user_restaurant`";

$create_user_restaurant_table = "CREATE TABLE `restaurants` (
   `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   `user_id` int(10) NOT NULL,
   `restaurant_id` int(10) NOT NULL,
   FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
   FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

?>