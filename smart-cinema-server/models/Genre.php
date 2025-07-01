<?php


class Genre extends Model {
    public ?int $genre_id;
    public ?string $name;
    protected static string $table = 'genres';

    public function __construct(array $data = []) {
        $this->genre_id = $data['genre_id'] ?? null;
        $this->name = $data['name'] ?? null;
    }

    public function toArray() {
        return [
            "genre_id" => $this->genre_id,
            "name" => $this->name
        ];
    }
}
