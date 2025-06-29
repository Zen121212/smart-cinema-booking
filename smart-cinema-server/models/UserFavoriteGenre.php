<?php
require_once("Model.php");

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
}