<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `showroom_id` int(11) NOT NULL,
  `seat_label` varchar(10) NOT NULL,
  `seat_row` varchar(5) DEFAULT NULL,
  `seat_number` int(11) DEFAULT NULL,
  `seat_type` enum('standard','premium','VIP') DEFAULT 'standard',
  PRIMARY KEY (`id`),
  KEY `showroom_id` (`showroom_id`),
  CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE
)";

$mysqli->query($query);
$mysqli->close();