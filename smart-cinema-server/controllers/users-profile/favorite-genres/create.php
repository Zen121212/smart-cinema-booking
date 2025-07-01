<?php
require_once("../../../connection/connection.php");
require_once("../../../models/UserProfile.php");
require_once("../../../models/UserFavoriteGenre.php");

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
// var_dump($userProfile);
if (!$userProfile) {
    echo json_encode([
        "error" => "User profile not found."
    ]);
    exit;
}

$favorite_genres = $_POST['favorite_genres'] ?? [];

if (!is_array($favorite_genres)) {
    $favorite_genres = [$favorite_genres];
}

if (!empty($favorite_genres)) {
    UserFavoriteGenre::addGenresForUser($user_profile_id, $favorite_genres);
}

echo json_encode([
    "success" =>true,
    "message" => "Favorite genres saved successfully."
]);
