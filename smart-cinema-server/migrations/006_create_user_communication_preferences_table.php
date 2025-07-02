<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `user_communication_preferences` (
  `user_profile_id` int(11) NOT NULL,
  `preference_id` int(11) NOT NULL,
  PRIMARY KEY (`user_profile_id`,`preference_id`),
  KEY `preference_id` (`preference_id`),
  CONSTRAINT `user_communication_preferences_ibfk_1` FOREIGN KEY (`user_profile_id`) REFERENCES `users_profile` (`user_profile_id`) ON DELETE CASCADE,
  CONSTRAINT `user_communication_preferences_ibfk_2` FOREIGN KEY (`preference_id`) REFERENCES `communication_preferences` (`preference_id`) ON DELETE CASCADE
)";

$mysqli->query($query);
$mysqli->close();
