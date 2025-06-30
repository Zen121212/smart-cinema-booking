<?php
require_once("../../connection/connection.php");
require_once("../../models/Booking.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode([
        "error" => "Booking ID required."
    ]);
    exit;
}

$booking = Booking::find($id);

if (!$booking) {
    http_response_code(404);
    echo json_encode([
        "error" => "Booking not found."
    ]);
    exit;
}

echo json_encode([
    "booking" => $booking->toArray()
]);
