<?php
require_once("../../connection/connection.php");
require_once("../../models/Booking.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");
$id = $_GET['id'] ?? null;


// if (!$id) {
//     http_response_code(400);
//     echo json_encode([
//         "error" => "Booking ID required."
//     ]);
//     exit;
// }
// echo "user_id: " . $id;

$bookings = Booking::findAll($id, 'user_id');

$bookingArray = [];

if (!empty($bookings)) {
    foreach ($bookings as $b) {
        $bookingArray[] = $b->toArray();
    }

    header('Content-Type: application/json');
    echo json_encode([
        "success"=> true,
        "booking" => $bookingArray
    ],);
} else {
    header('Content-Type: application/json');
    echo json_encode([
        "error" => "Booking not found."
    ]);
}
