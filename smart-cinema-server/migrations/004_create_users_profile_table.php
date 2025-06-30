<?php 
require("../connection/connection.php");


$query = "CREATE TABLE `users_profile` (
        `user_profile_id` int(11) NOT NULL,
        `user_profile_username` varchar(255) DEFAULT NULL,
        `user_profile_name` varchar(255) DEFAULT NULL,
        `user_profile_last_name` varchar(255) DEFAULT NULL,
        `phone` varchar(50) DEFAULT NULL,
        `address` varchar(255) DEFAULT NULL,
        `bio` text,
        `avatar_image` text,
        PRIMARY KEY (`user_profile_id`),
        CONSTRAINT `users_profile_ibfk_1` FOREIGN KEY (`user_profile_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        )";

$conn->query($query);
$conn->close();
