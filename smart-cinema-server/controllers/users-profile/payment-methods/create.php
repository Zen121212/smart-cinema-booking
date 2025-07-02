<?php
require_once("../../../connection/connection.php");
require_once("../../../models/UserProfile.php");
require_once("../../../models/UserPaymentMethod.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");

if (!isset($_POST['user_profile_id'])) {
    echo json_encode([
        "error" => "missing POST data."
    ]);
    exit;
}

$user_profile_id = $_POST['user_profile_id'];

$userProfile = UserProfile::find($user_profile_id);

if (!$userProfile) {
    echo json_encode([
        "error" => "User profile not found."
    ]);
    exit;
}

$payment_methods = $_POST['payment_methods'] ?? [];

if (!is_array($payment_methods)) {
    $payment_methods = [$payment_methods];
}

if (!empty($payment_methods)) {
    UserPaymentMethod::addPaymentMethodForUser($user_profile_id, $payment_methods);
}
echo json_encode([
    "success" => true,
    "message" => "Favorite payment method saved successfully."
]);
