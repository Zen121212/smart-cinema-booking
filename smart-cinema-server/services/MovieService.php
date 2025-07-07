<?php
require_once __DIR__ . "/../models/Movie.php";
class MovieService {
    public static function getAllMovies(){
        $movies = Movie::all();
        $moviesArray = [];
        foreach ($movies as $movie) {
            $moviesArray[] = $movie->toArray();
        }

        return $moviesArray;
    }
    public static function getMoviesByStatus(string $statusFilter){
        $movies = Movie::findAll($statusFilter, "status");
        $moviesArray = [];
        foreach ($movies as $movie) {
            $moviesArray[] = $movie->toArray();
        }

        return $moviesArray;
    }
}