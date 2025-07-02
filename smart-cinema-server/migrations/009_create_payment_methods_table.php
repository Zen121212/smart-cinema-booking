<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(100) NOT NULL,
  PRIMARY KEY (`payment_method_id`))";

$mysqli->query($query);
$mysqli->close();