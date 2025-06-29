<?php
require_once("../../../connection/connection.php");
require_once("../../../models/UserProfile.php");
require_once("../../../models/UserFavoriteGenre.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");

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

$favorite_genres = $_POST['favorite_genres'] ?? [];

if (!is_array($favorite_genres)) {
    $favorite_genres = [$favorite_genres];
}

if (!empty($favorite_genres)) {
    UserFavoriteGenre::addGenresForUser($user_profile_id, $favorite_genres);
}

echo json_encode([
    "message" => "Favorite genres saved successfully."
]);
