<?php
require_once("../../connection/connection.php");
require_once("../../models/Movie.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Model::setConnection($mysqli);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");
if (!isset($_POST['id'])) {
    echo json_encode([
        "error" => "Invalid or missing POST data."
    ]);
    exit;
}

$movie_id = $_POST['id'];

$movie = Movie::find($movie_id);

if ($movie) {
    Movie::delete($movie_id);

    echo json_encode([
        "message" => "Movie deleted successfully.",
        "user_deleted" => $movie->toArray()
    ]);
    return;
} else {
    echo json_encode(["error" => "Movie does not exist."]);
return;
}

