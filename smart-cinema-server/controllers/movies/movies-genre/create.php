<?php
require_once("../../../connection/connection.php");
require_once("../../../models/Movie.php");
require_once("../../../models/MovieGenre.php");

Model::setConnection($mysqli);
header("Content-Type: application/json");

if (!isset($_POST['movie_id'])) {
    echo json_encode([
        "error" => "Invalid or missing POST data."
    ]);
    exit;
}

$movie_id = $_POST['movie_id'];
$movie = Movie::find($movie_id);
// var_dump($movie);
if (!$movie) {
    echo json_encode([
        "error" => "Movie not found."
    ]);
    exit;
}

$genres = $_POST['genres_id'] ?? [];
if (!is_array($genres)) {
    $genres = [$genres];
}

if (!empty($genres)) {
    MovieGenre::addGenresForMovie($movie_id, $genres);
}

echo json_encode([
    "message" => "Movie genres saved successfully."
]);