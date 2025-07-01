<?php
require_once("../../connection/connection.php");
require_once("../../models/User.php");
require_once("../../models/UserProfile.php");


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

$user_profile_id = (int)$_GET['user_profile_id'];

$userProfile = UserProfile::find($user_profile_id);

if ($userProfile) {
    echo json_encode([
        "status" => 200,
        "user_profile" => $userProfile->toArray()
    ]);
} else {
    echo json_encode([
        "error" => "User profile not found."
    ]);
}
