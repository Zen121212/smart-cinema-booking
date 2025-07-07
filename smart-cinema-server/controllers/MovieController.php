<?php
require(__DIR__ . "/../connection/connection.php");
require_once __DIR__ . '/../models/Movie.php';
require_once __DIR__ . '/../services/ResponseService.php';
require_once __DIR__ . '/../services/MovieService.php';

Model::setConnection($mysqli);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

class MovieController {
    public function getAllMovies(){
        try {
            $movies = MovieService::getAllMovies();
            echo ResponseService::response([
                "movies" => $movies
            ], 200);

        } catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 500);
        }
    }
    public function getMoviesByStatus(){
        try {
            $statusFilter = $_GET['status'] ?? null;

            $moviesArray = MovieService::getMoviesByStatus($statusFilter);

            echo ResponseService::response([
                "movies" => $moviesArray
            ], 200);

        } catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 500);
        }
    }

}
