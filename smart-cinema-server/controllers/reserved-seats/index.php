<?php 

require_once("../../connection/connection.php");
require_once("../../models/Booking.php");


Model::setConnection($mysqli);

header("Content-Type: application/json");

$reservedSeats = Booking::getAllReservedSeats();

echo json_encode([
    "reserved_seats" => $reservedSeats
]);
