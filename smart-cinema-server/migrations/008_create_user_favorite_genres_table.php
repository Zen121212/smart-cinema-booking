<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `user_favorite_genres` (
  `user_profile_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`user_profile_id`,`genre_id`),
  KEY `genre_id` (`genre_id`),
  CONSTRAINT `user_favorite_genres_ibfk_1` FOREIGN KEY (`user_profile_id`) REFERENCES `users_profile` (`user_profile_id`) ON DELETE CASCADE,
  CONSTRAINT `user_favorite_genres_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE
)";

$conn->query($query);
$conn->close();