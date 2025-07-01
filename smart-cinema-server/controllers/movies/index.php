<?php 

require_once("../../connection/connection.php");
require_once("../../models/Movie.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");

$response = [];

$id = $_GET['id'] ?? null;
$genreFilter = $_GET['genre'] ?? null;
$statusFilter = $_GET['status'] ?? null;

if ($id) {
    $movie = Movie::find($id);
    if (!$movie) {
        echo json_encode(["error" => "Movie not found."]);
        exit;
    }
    $response["movie"] = $movie->toArray();
} 
else if ($genreFilter) {
    $movies = Movie::getMoviesByGenreName($genreFilter);
    $response["movies"] = $movies;
}
else if ($statusFilter) {
    $movies = Movie::findAll($statusFilter, "status");
echo"test";
    $moviesArray = [];
    foreach ($movies as $movie) {
        $moviesArray[] = $movie->toArray();
    }

    $response["movies"] = $moviesArray;
}
else {
    $movies = Movie::all();
    foreach ($movies as $m) {
        $response["movies"][] = $m->toArray();
    }
}

echo json_encode($response);
