<?php
require_once("Model.php");

class MovieGenre extends Model
{
    public int $movie_id;
    public int $genre_id;
    protected static string $table = 'movie_genres';

    public function __construct(array $data)
    {
        $this->movie_id = $data['movie_id'] ?? null;
        $this->genre_id = $data['genre_id'] ?? null;
    }

    public function toArray()
    {
        return [
            'movie_id' => $this->movie_id,
            'genre_id' => $this->genre_id
        ];
    }

    public static function addGenresForMovie($movie_id, array $genre_ids)
    {
        foreach ($genre_ids as $genre_id) {
            static::create([
                'movie_id' => $movie_id,
                'genre_id' => $genre_id
            ]);
        }
    }
}