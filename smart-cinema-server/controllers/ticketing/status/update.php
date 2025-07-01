<?php
require_once("../../../connection/connection.php");
require_once("../../../models/Booking.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");

if (!isset($_POST['booking_id'], $_POST['new_status'])) {
    http_response_code(400);
    echo json_encode([
        "error" => "booking_id and new_status are required."
    ]);
    exit;
}

$bookingId = intval($_POST['booking_id']);
$newStatus = $_POST['new_status'];

$booking = Booking::find($bookingId);

if (!$booking) {
    http_response_code(404);
    echo json_encode([
        "error" => "Booking not found."
    ]);
    exit;
}

$updatedBooking = $booking->updateStatus($newStatus);

if ($updatedBooking) {
    echo json_encode([
        "message" => "Booking status updated successfully.",
        "booking" => $updatedBooking->toArray()
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "error" => "Failed to update booking status."
    ]);
}
