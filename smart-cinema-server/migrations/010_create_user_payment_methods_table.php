<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `user_payment_methods` (
  `user_profile_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  PRIMARY KEY (`user_profile_id`,`payment_method_id`),
  KEY `payment_method_id` (`payment_method_id`),
  CONSTRAINT `user_payment_methods_ibfk_1` FOREIGN KEY (`user_profile_id`) REFERENCES `users_profile` (`user_profile_id`) ON DELETE CASCADE,
  CONSTRAINT `user_payment_methods_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`payment_method_id`) ON DELETE CASCADE
)";

$mysqli->query($query);
$mysqli->close();

