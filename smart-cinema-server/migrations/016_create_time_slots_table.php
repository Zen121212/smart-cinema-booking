<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `time_slots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`)
)";

$conn->query($query);
$conn->close();