<?php
require_once("../../../connection/connection.php");
require_once("../../../models/UserPaymentMethod.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");

if (!isset($_GET['user_profile_id'])) {
    echo json_encode([
        "error" => "Missing user_profile_id parameter."
    ]);
    exit;
}

$user_profile_id = $_GET['user_profile_id'];

$payment_methods = UserPaymentMethod::findAll($user_profile_id);

$methods_array = [];
foreach ($payment_methods as $method) {
    $methods_array[] = $method->toArray();
}

echo json_encode([
    "user_profile_id" => $user_profile_id,
    "payment_methods" => $methods_array
]);
