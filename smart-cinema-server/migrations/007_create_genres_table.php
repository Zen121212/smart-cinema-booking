<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`genre_id`)
)";

$conn->query($query);
$conn->close();