<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `status` enum('coming_soon','on_showtime') DEFAULT 'coming_soon',
  `description` text,
  `release_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
)";

$mysqli->query($query);
$mysqli->close();