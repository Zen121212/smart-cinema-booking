<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `communication_preferences` (
  `preference_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`preference_id`)
)";

$conn->query($query);
$conn->close();
