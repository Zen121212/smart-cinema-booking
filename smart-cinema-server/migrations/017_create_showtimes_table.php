<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `time_slot_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  KEY `showroom_id` (`showroom_id`),
  KEY `time_slot_id` (`time_slot_id`),
  CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `showtimes_ibfk_2` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `showtimes_ibfk_3` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slots` (`id`) ON DELETE CASCADE
)";

$conn->query($query);
$conn->close();