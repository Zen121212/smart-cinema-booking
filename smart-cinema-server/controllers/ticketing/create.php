<?php
require_once("../../connection/connection.php");
require_once("../../models/Booking.php");
require_once("../../models/Wallet.php");
Model::setConnection($mysqli);

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");
$required = ['user_id', 'movie_id', 'showtime_id', 'seat_id', 'total_price', 'booking_status'];
$missing = [];

foreach ($required as $field) {
    if (!isset($_POST[$field])) {
        $missing[] = $field;
    }
}

if (!empty($missing)) {
    http_response_code(400);
    echo json_encode([
        "error" => "Missing required fields.",
        "fields" => $missing
    ]);
    exit;
}
$user_id = $_POST['user_id'];
$wallet = Wallet::find( $user_id);
$showtimeId = $_POST['showtime_id'];
$seatId = $_POST['seat_id'];

$is_booked = Booking::checkReservation($showtimeId, $seatId);

$total_price = floatval($_POST['total_price']);
$status = $_POST['booking_status'];


if ($status === 'paid') {
    $deductedWallet = $wallet->updateBalance($total_price, $status);

    if (!$deductedWallet) {
        echo json_encode(["error" => "Insufficient funds in wallet."]);
        exit;
    }
}

$data = [
    'user_id' => intval($_POST['user_id']),
    'movie_id' => intval($_POST['movie_id']),
    'showtime_id' => intval($_POST['showtime_id']),
    'seat_id' => intval($_POST['seat_id']),
    'total_price' => floatval($_POST['total_price']),
    'purchase_date' => date('Y-m-d H:i:s'),
    'booking_status' => $_POST['booking_status'],
];

$booking = Booking::create($data);

if ($booking) {
    echo json_encode([
        "message" => "Booking created successfully.",
        "booking" => $booking->toArray()
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "error" => "Failed to create booking."
    ]);
}
