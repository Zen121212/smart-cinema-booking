<?php
require_once("Model.php");
require_once("Genre.php");

class UserFavoriteGenre extends Model
{
    protected static string $primary_key = 'id';
    public int $user_profile_id;
    public int $genre_id;
    protected static string $table = 'user_favorite_genres';

    public function __construct(array $data)
    {
        $this->user_profile_id = $data['user_profile_id'] ?? null;
        $this->genre_id = $data['genre_id'] ?? null;
    }

    public function toArray()
    {
        return [
            'user_profile_id' => $this->user_profile_id,
            'genre_id' => $this->genre_id
        ];
    }

    public static function addGenresForUser($user_profile_id, array $genre_ids)
    {
        foreach ($genre_ids as $genre_id) {
            static::create([
                'user_profile_id' => $user_profile_id,
                'genre_id' => $genre_id
            ]);
        }
    }
    
    public static function getGenresForUser($user_profile_id) {

        $sql ="
            SELECT g.genre_id, g.name
            FROM user_favorite_genres ufg
            JOIN genres g ON ufg.genre_id = g.genre_id
            WHERE ufg.user_profile_id = ?;
        ";
        

        $query = static::$mysqli->prepare($sql);
        $query->bind_param("i", $user_profile_id);
        $query->execute();
        $result = $query->get_result();

        $genres = [];
        while ($row = $result->fetch_assoc()) {
            $genre = new Genre($row);
            $genres[] = $genre;
        }

        return $genres;
}
}