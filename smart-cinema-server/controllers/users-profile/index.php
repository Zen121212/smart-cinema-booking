<?php
require_once("../../connection/connection.php");
require_once("../../models/User.php");
require_once("../../models/UserProfile.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


Model::setConnection($mysqli);

header("Content-Type: application/json");

if (!isset($_GET['user_profile_id'])) {
    http_response_code(400);
    echo json_encode([
        "error" => "Missing user_profile_id parameter."
    ]);
    exit;
}

$user_profile_id = (int)$_GET['user_profile_id'];

$userProfile = UserProfile::find($user_profile_id, 'user_profile_id');

if ($userProfile) {
    echo json_encode([
        "status" => 200,
        "user_profile" => $userProfile->toArray()
    ]);
} else {
    http_response_code(404);
    echo json_encode([
        "error" => "User profile not found."
    ]);
}
