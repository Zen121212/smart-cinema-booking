<?php
require_once("../../../connection/connection.php");
require_once("../../../models/UserProfile.php");
require_once("../../../models/UserFavoriteGenre.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *"); // Allows requests from any origin
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Specify allowed methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Specify allowed headers
header("Access-Control-Max-Age: 3600"); 

// Check if a user_profile_id was provided via GET
if (!isset($_GET['user_profile_id'])) {
    echo json_encode([
        "error" => "Missing user_profile_id parameter."
    ]);
    exit;
}

$user_profile_id = $_GET['user_profile_id'];

// Find the user profile
$userProfile = UserProfile::find($user_profile_id);
if (!$userProfile) {
    echo json_encode([
        "error" => "User profile not found."
    ]);
    exit;
}

$favoriteGenres = UserFavoriteGenre::getGenresForUser($user_profile_id);
// var_dump($userProfile);

if (!empty($favoriteGenres)) {

    $genreArray = [];
    foreach ($favoriteGenres as $genre) {
        $genreArray[] = $genre->toArray();
    }

    echo json_encode([
        "favorite_genres" => $genreArray
    ]);
} else {
    echo json_encode([
        "favorite_genres" => []
    ]);
}
