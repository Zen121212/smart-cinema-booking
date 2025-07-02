<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
)";

$mysqli->query($query);
$mysqli->close();