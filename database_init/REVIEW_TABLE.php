<?php

$drop_reviews_table = "DROP TABLE IF EXISTS `reviews`";

$create_reviews_table = "CREATE TABLE `reviews` (
   `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   `content` text NOT NULL,
   `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

?>
