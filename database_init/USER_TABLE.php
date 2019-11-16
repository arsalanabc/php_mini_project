<?php

$drop_users_table = "DROP TABLE IF EXISTS `users`";

$create_users_table = "CREATE TABLE `users` (
   `id` int(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
   `username` varchar(20) NOT NULL,
   `email` varchar(50) NOT NULL,
   `first_name` varchar(20) DEFAULT NULL,
   `last_name` varchar(20) DEFAULT NULL,
   `password` varchar(50) NOT NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

?>
