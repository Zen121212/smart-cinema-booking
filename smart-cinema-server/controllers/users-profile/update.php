<?php
require_once("../../connection/connection.php");
require_once("../../models/UserProfile.php");
require_once("../../models/UserFavoriteGenre.php");
require_once("../../models/UserPaymentMethod.php");



Model::setConnection($mysqli);

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");


header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");
$user_profile_id = $_POST['user_profile_id'] ?? null;

if (!$user_profile_id) {
    echo json_encode(["error" => "Missing user_profile_id."]);
    return;
}

$fields = [
    'user_profile_username',
    'user_profile_name',
    'user_profile_last_name',
    'phone',
    'address',
    'bio',
    'avatar_image'
];

$data = [];

foreach ($fields as $field) {
    if (isset($_POST[$field]) && trim($_POST[$field]) !== '') {
        $data[$field] = $_POST[$field];
    }
}


$userProfile = UserProfile::find($user_profile_id);

if (!$userProfile) {

    echo json_encode([
        "error" => "User profile not found."
    ]);
    exit;
}

$updatedProfile = UserProfile::update($user_profile_id, $data);

echo json_encode([
    "success"=>true,
    "message" => "User profile updated successfully.",
    "user_profile" => $updatedProfile->toArray()
]);
