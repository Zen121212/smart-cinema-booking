<?php
require_once("../../connection/connection.php");
require_once("../../models/Movie.php");
require_once("../../models/MovieGenre.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Model::setConnection($mysqli);
header("Content-Type: application/json");

if (!isset($_POST['title'], $_POST['description'], $_POST['duration'], $_POST['status'], $_POST['release_date'])) {
    echo json_encode([
        "error" => "Invalid or missing POST data."
    ]);
    return;
}

$data = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'duration' => (int)$_POST['duration'],
    'status' => $_POST['status'],
    'release_date' => $_POST['release_date'],
];

$movie = Movie::create($data);

if ($movie) {
    echo json_encode([
        "message" => "Movie created successfully.",
        "movie" => $movie->toArray()
    ]);
} else {
    echo json_encode([
        "error" => "Failed to create movie."
    ]);
}