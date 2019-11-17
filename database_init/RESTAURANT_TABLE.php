<?php

$drop_restaurants_table = "DROP TABLE IF EXISTS `restaurants`";

$create_restaurants_table = "CREATE TABLE `restaurants` (
   `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   `name` varchar(50) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

?>
