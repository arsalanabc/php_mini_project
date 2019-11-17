<?php

$drop_restaurant_review_table = "DROP TABLE IF EXISTS `restaurant_review`";

$create_restaurant_review_table = "CREATE TABLE `restaurant_review` (
   `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   `review_id` int(10) NOT NULL,
   `restaurant_id` int(10) NOT NULL,
   FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
   FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

?>