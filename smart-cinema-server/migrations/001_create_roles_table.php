<?php 
require("../connection/connection.php");


$query = "CREATE TABLE roles (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY name (name))";

$conn->query($query);
$conn->close();