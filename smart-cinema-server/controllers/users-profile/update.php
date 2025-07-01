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
if (!isset( $_POST['user_profile_username'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['bio'], 
            $_POST['avatar_image'])) 
    {
    echo json_encode([
        "error" => "missing POST data."
    ]);
    return;
}
$user_profile_id = $_POST['user_profile_id'];

$data = [
    'user_profile_username' => $_POST['user_profile_username'],
    'phone' => $_POST['phone'],
    'address' => $_POST['address'],
    'bio' => $_POST['bio'],
    'avatar_image' => $_POST['avatar_image'],
];

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
