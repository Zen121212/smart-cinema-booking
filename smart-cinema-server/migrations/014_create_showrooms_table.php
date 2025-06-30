<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `showrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)";

$conn->query($query);
$conn->close();