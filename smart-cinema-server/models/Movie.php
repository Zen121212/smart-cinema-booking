<?php
require_once("Model.php");

class Movie extends Model {
    protected int $id;
    private string $title;
    private string $description;
    private int $duration;
    private string $status;
    private string $release_date;
    private $genre_id;
    private $genre_name;
    protected static string $table = "movies";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->description = $data["description"];
        $this->duration = $data["duration"];
        $this->status = $data["status"];
        $this->release_date = $data["release_date"];
        $this->genre_id = $data['genre_id'] ?? null;
        $this->genre_name = $data['genre_name'] ?? null;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDuration(): int {
        return $this->duration;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getReleaseDate(): string {
        return $this->release_date;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setDuration(int $duration): void {
        $this->duration = $duration;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setReleaseDate(string $release_date): void {
        $this->release_date = $release_date;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "duration" => $this->duration,
            "status" => $this->status,
            "release_date" => $this->release_date,
        ];
    }

public static function getMoviesByGenreName($genreName) {
    $sql = "SELECT
                m.id,
                m.title,
                m.duration,
                m.`status`,
                m.description,
                m.release_date,
                g.genre_id,
                g.name AS genre_name
            FROM movies m
            LEFT JOIN movie_genres mg ON m.id = mg.movie_id
            LEFT JOIN genres g ON mg.genre_id = g.genre_id
            WHERE g.name = ?";

    $stmt = self::$mysqli->prepare($sql);
    $stmt->bind_param("s", $genreName);
    $stmt->execute();

    $result = $stmt->get_result();
    $movies = [];

    while ($row = $result->fetch_assoc()) {
        $movie = new self([
            "id" => $row["id"],
            "title" => $row["title"],
            "description" => $row["description"],
            "duration" => $row["duration"],
            "status" => $row["status"],
            "release_date" => $row["release_date"],
        ]);
        $movies[] = [
            "movie" => $movie->toArray(),
            "genre_id" => $row["genre_id"],
            "genre_name" => $row["genre_name"]
        ];
    }

    return $movies;
}


}